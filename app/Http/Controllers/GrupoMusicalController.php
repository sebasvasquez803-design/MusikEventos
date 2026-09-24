<?php

namespace App\Http\Controllers;

use App\Models\GrupoMusical;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GrupoMusicalController extends Controller
{
    // Muestra los grupos procesando la presentación del 'segundo código' directamente aquí
    public function home()
    {
        $buscar = trim((string) request('buscar'));

        $grupos = GrupoMusical::query()
            ->when($buscar !== '', function ($consulta) use ($buscar) {
                $consulta->where('nombre_grupo', 'like', "%{$buscar}%");
            })
            ->latest('nit')
            ->paginate(6)
            ->withQueryString();

        $grupos->through(function ($grupo) {
            $grupo->artista_nombre = $grupo->nombre_grupo ?? 'Grupo musical';
            $grupo->artista_imagen = $grupo->avatar_url ?? asset('storage/img/inside.jpeg');
            $grupo->artista_logo = $grupo->logo_url ?? $grupo->avatar_url ?? asset('storage/img/logo_arca.jpg');
            $grupo->artista_descripcion = $grupo->descripcion ?: 'Grupo musical disponible para eventos.';
            $grupo->artista_precio = $grupo->precio_hora
                ? '$' . number_format((float) $grupo->precio_hora, 0, ',', '.')
                : 'Consultar precio';

            $grupo->artista_video = $grupo->video_url
                ? (str_starts_with($grupo->video_url, 'http')
                    ? preg_replace('/\?.*/', '', $grupo->video_url)
                    : Storage::disk('public')->url($grupo->video_url))
                : '';

            $grupo->reseñas = $grupo->resenas
                ->map(function ($resena) {
                    return [
                        'nombre' => $resena->nombre_usuario ?: 'Usuario',
                        'avatar' => strtoupper(substr(($resena->nombre_usuario ?: 'U'), 0, 1)),
                        'texto' => $resena->comentario ?: 'Excelente experiencia.',
                        'estrellas' => $resena->numero_estrellas ?? 5,
                        'id_resena' => $resena->id_resena,
                    ];
                })
                ->values()
                ->all();

            if (empty($grupo->reseñas)) {
                $grupo->reseñas = [[
                    'nombre' => 'Nuevo usuario',
                    'avatar' => 'N',
                    'texto' => 'Aún no hay reseñas para este grupo. ¡Sé el primero en dejar tu opinión!',
                    'estrellas' => 5,
                    'id_resena' => null,
                ]];
            }

            $grupoGeneros = [];

            try {
                $grupoGeneros = DB::table('subgenero')
                    ->where('nit', $grupo->nit)
                    ->pluck('nombre_subgenero')
                    ->toArray();
            } catch (\Throwable $e) {
                $grupoGeneros = [];
            }

            if (!empty($grupo->id_subgenero)) {
                try {
                    $subGenero = DB::table('subgenero')
                        ->where('id_subgenero', $grupo->id_subgenero)
                        ->first();

                    if ($subGenero && !empty($subGenero->nombre_subgenero)) {
                        $grupoGeneros[] = $subGenero->nombre_subgenero;
                    }

                    if ($subGenero && !empty($subGenero->id_genero)) {
                        $genero = DB::table('genero')
                            ->where('id_genero', $subGenero->id_genero)
                            ->value('nombre_genero');

                        if ($genero) {
                            $grupoGeneros[] = $genero;
                        }
                    }
                } catch (\Throwable $e) {
                    // Ignora errores si la relación de géneros no está disponible.
                }
            }

            $grupo->generos = array_values(array_unique(array_filter($grupoGeneros, fn ($genero) => !empty($genero))));
            $grupo->genero_attr = implode(',', $grupo->generos);
            $grupo->can_manage = auth()->user()?->canManageMusicalGroups() ? '1' : '0';

            return $grupo;
        });

        return view('index1', [
            'grupos' => $grupos,
        ]);
    }

    // Valida y registra un grupo desde el formulario web
    public function storeFromForm(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nit' => ['required', 'string', 'unique:grupo_musical,nit', 'digits:10'],
            'id_subgenero' => ['required', 'integer', 'exists:subgenero,id_subgenero'],
            'nombre_grupo' => ['required', 'string', 'max:50'],
            'telefono' => ['required', 'string', 'digits:10'],
            'email' => ['required', 'email', 'max:50'],
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'logo' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'video_url' => ['nullable', 'url', 'max:500'],
            'video_file' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/quicktime,video/x-msvideo', 'max:25000'],
            'descripcion' => ['nullable', 'string', 'max:500'],
            'numero_doc' => ['nullable', 'string', 'digits:10', 'exists:usuario,numero_doc'],
            'precio_hora' => ['required', 'numeric', 'min:0.01'],
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('grupos', 'public');
        }

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('grupos', 'public');
        }

        if ($request->hasFile('video_file')) {
            $validated['video_url'] = $request->file('video_file')->store('videos', 'public');
        } elseif ($request->filled('video_url')) {
            $validated['video_url'] = $request->input('video_url');
        } else {
            $validated['video_url'] = null;
        }

        $grupoMusical = new GrupoMusical();
        $grupoMusical->fill($validated);
        $grupoMusical->save();

        return redirect()->route('home')->with([
            'success' => 'Grupo musical registrado correctamente.',
            'grupoMusical' => $grupoMusical,
        ]);
    }

    // Muestra el formulario de edición para administradores autorizados
    public function edit(GrupoMusical $grupoMusical)
    {
        abort_unless(auth()->user()?->canManageMusicalGroups(), 403);

        return view('sesion.editar_grupo', compact('grupoMusical'));
    }

    // Actualiza los datos del grupo y reemplaza sus archivos
    public function updateFromForm(Request $request, GrupoMusical $grupoMusical): RedirectResponse
    {
        abort_unless(auth()->user()?->canManageMusicalGroups(), 403);

        $validated = $request->validate([
            'nombre_grupo' => ['required', 'string', 'max:50'],
            'id_subgenero' => ['sometimes','required','integer','exists:subgenero,id_subgenero'],
            'telefono' => ['required', 'string', 'digits:10'],
            'email' => ['required', 'email', 'max:50'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'video_url' => ['nullable', 'url', 'max:500'],
            'video_file' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/quicktime,video/x-msvideo', 'max:25000'],
            'descripcion' => ['nullable', 'string', 'max:500'],
            'numero_doc' => ['nullable', 'string', 'digits:10', 'exists:usuario,numero_doc'],
            'precio_hora' => ['nullable', 'numeric'],
        ]);

        if ($request->hasFile('avatar')) {
            if ($grupoMusical->avatar) {
                Storage::disk('public')->delete($grupoMusical->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('grupos', 'public');
        } else {
            unset($validated['avatar']);
        }

        if ($request->hasFile('logo')) {
            if ($grupoMusical->logo) {
                Storage::disk('public')->delete($grupoMusical->logo);
            }
            $validated['logo'] = $request->file('logo')->store('grupos', 'public');
        } else {
            unset($validated['logo']);
        }

        if ($request->hasFile('video_file')) {
            if ($grupoMusical->video_url && !str_starts_with($grupoMusical->video_url, 'http')) {
                Storage::disk('public')->delete($grupoMusical->video_url);
            }
            $validated['video_url'] = $request->file('video_file')->store('videos', 'public');
        } elseif ($request->filled('video_url')) {
            $validated['video_url'] = $request->input('video_url');
        } else {
            unset($validated['video_url']);
        }

        $grupoMusical->update($validated);

        return redirect()->route('home')->with('success', 'Grupo musical actualizado correctamente.');
    }

    // Elimina el grupo y sus recursos asociados
    public function destroyFromForm(GrupoMusical $grupoMusical): RedirectResponse
    {
        abort_unless(auth()->user()?->canDeleteMusicalGroups(), 403);

        if ($grupoMusical->avatar) {
            Storage::disk('public')->delete($grupoMusical->avatar);
        }

        try {
            $grupoNit = $grupoMusical->nit;
            if ($grupoNit) {
                DB::table('resenas')->where('nit', $grupoNit)->delete();
            }
        } catch (\Throwable $e) {
            // Ignora errores si la tabla resenas no aplica
        }

        $grupoMusical->delete();

        return redirect()->route('home')->with('success', 'Grupo musical eliminado correctamente.');
    }

    // --- Endpoints JSON / API ---
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => GrupoMusical::query()->latest('nit')->paginate(15),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nit' => ['required', 'string', 'unique:grupo_musical,nit', 'digits:10'],
            'nombre_grupo' => ['nullable', 'string', 'max:50'],
            'telefono' => ['nullable', 'string', 'max:10'],
            'email' => ['nullable', 'email', 'max:50'],
            'avatar' => ['nullable', 'string'],
            'descripcion' => ['nullable', 'string'],
            'numero_doc' => ['nullable', 'string', 'max:10', 'exists:usuario,numero_doc'],
            'precio_hora' => ['nullable', 'numeric'],
        ]);

        $grupoMusical = GrupoMusical::create($validated);

        return response()->json(['data' => $grupoMusical], 201);
    }

    public function show(GrupoMusical $grupoMusical): JsonResponse
    {
        return response()->json(['data' => $grupoMusical]);
    }

    public function update(Request $request, GrupoMusical $grupoMusical): JsonResponse
    {
        $validated = $request->validate([
            'nit' => ['sometimes', 'required', 'string', 'unique:grupo_musical,nit,' . $grupoMusical->nit . ',nit', 'digits:10'],
            'nombre_grupo' => ['sometimes', 'nullable', 'string', 'max:50'],
            'telefono' => ['sometimes', 'nullable', 'string', 'max:10'],
            'email' => ['sometimes', 'nullable', 'email', 'max:50'],
            'avatar' => ['sometimes', 'nullable', 'string'],
            'descripcion' => ['sometimes', 'nullable', 'string'],
            'numero_doc' => ['sometimes', 'nullable', 'string', 'max:10', 'exists:usuario,numero_doc'],
            'precio_hora' => ['sometimes', 'nullable', 'numeric'],
        ]);

        $grupoMusical->update($validated);

        return response()->json(['data' => $grupoMusical->fresh()]);
    }

    public function destroy(GrupoMusical $grupoMusical): JsonResponse
    {
        $grupoMusical->delete();

        return response()->json(status: 204);
    }
}

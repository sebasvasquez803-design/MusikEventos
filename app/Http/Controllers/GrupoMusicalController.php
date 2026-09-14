<?php

namespace App\Http\Controllers;

use App\Models\GrupoMusical;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GrupoMusicalController extends Controller
{
    // Muestra los grupos, aplicando búsqueda y paginación para la página principal.
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

        return view('index1', [
            'grupos' => $grupos,
        ]);
    }

    // Valida y registra un grupo desde el formulario web.
    public function storeFromForm(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nit' => ['required', 'string', 'unique:grupo_musical,nit', 'digits:10'],
            'nombre_grupo' => ['required', 'string', 'max:50'],
            'telefono' => ['required', 'string', 'digits:10'],
            'email' => ['required', 'email', 'max:50'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'descripcion' => ['nullable', 'string', 'max:500'],
            'numero_doc' => ['nullable', 'string', ':digits10', 'exists:usuario,numero_doc'],
            'precio_hora' => ['nullable', 'numeric'],
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('grupos', 'public');
        }

        $grupoMusical = new GrupoMusical();
        $grupoMusical->fill($validated);
        $grupoMusical->save();

        return redirect()->route('home')->with([
            'success' => 'Grupo musical registrado correctamente.',
            'grupoMusical' => $grupoMusical,
        ]);
    }

    // Muestra el formulario de edición para administradores autorizados.
    public function edit(GrupoMusical $grupoMusical)
    {
        abort_unless(auth()->user()?->canManageMusicalGroups(), 403);

        return view('sesion.editar_grupo', compact('grupoMusical'));
    }

    // Actualiza los datos del grupo y reemplaza su imagen si se proporciona otra.
    public function updateFromForm(Request $request, GrupoMusical $grupoMusical): RedirectResponse
    {
        abort_unless(auth()->user()?->canManageMusicalGroups(), 403);

        $validated = $request->validate([
            'nombre_grupo' => ['required', 'string', 'max:50'],
            'telefono' => ['required', 'string', 'digits:10'],
            'email' => ['required', 'email', 'max:50'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
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

        $grupoMusical->update($validated);

        return redirect()->route('home')->with('success', 'Grupo musical actualizado correctamente.');
    }

    // Elimina el grupo y su imagen asociada.
    public function destroyFromForm(GrupoMusical $grupoMusical): RedirectResponse
    {
        abort_unless(auth()->user()?->canDeleteMusicalGroups(), 403);

        if ($grupoMusical->avatar) {
            Storage::disk('public')->delete($grupoMusical->avatar);
        }

        $grupoMusical->delete();

        return redirect()->route('home')->with('success', 'Grupo musical eliminado correctamente.');
    }

    // Devuelve grupos paginados para el endpoint JSON.
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => GrupoMusical::query()->latest('nit')->paginate(15),
        ]);
    }

    // Crea un grupo mediante el endpoint JSON.
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

    // Devuelve un grupo específico mediante el endpoint JSON.
    public function show(GrupoMusical $grupoMusical): JsonResponse
    {
        return response()->json(['data' => $grupoMusical]);
    }

    // Actualiza un grupo mediante el endpoint JSON.
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

    // Elimina un grupo mediante el endpoint JSON.
    public function destroy(GrupoMusical $grupoMusical): JsonResponse
    {
        $grupoMusical->delete();

        return response()->json(status: 204);
    }
}

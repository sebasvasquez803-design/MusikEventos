<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CurriculumController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Curriculum::query()->latest('id_experiencia')->paginate(15),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'anio_inicio' => ['nullable', 'integer'],
            'anio_fin' => ['nullable', 'integer'],
            'eventos_realizados' => ['nullable', 'integer'],
            'titulo_obtenido' => ['nullable', 'string'],
            'habilidades_principales' => ['nullable', 'string', 'max:150'],
            'academia_formacion' => ['nullable', 'string', 'max:50'],
            'estudios' => ['nullable', 'string', 'max:100'],
            'publico_privado' => ['nullable', 'string', 'max:20'],
            'numero_doc' => ['nullable', 'string', 'digits:10', 'exists:usuario,numero_doc'],
        ]);

        $curriculum = Curriculum::create($validated);

        return response()->json(['data' => $curriculum], 201);
    }

    public function storeFromRepresentative(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'numero_doc' => ['required', 'string', 'digits:10', 'unique:usuario,numero_doc'],
            'apellido' => ['nullable', 'string', 'max:25'],
            'anio_inicio' => ['nullable', 'integer', 'min:1900', 'max:2100'],
            'anio_fin' => ['nullable', 'integer', 'min:1900', 'max:2100'],
            'eventos_realizados' => ['nullable', 'integer', 'min:0'],
            'titulo_obtenido' => ['nullable', 'string', 'max:300'],
            'habilidades_principales' => ['nullable', 'string', 'max:150'],
            'academia_formacion' => ['nullable', 'string', 'max:50'],
            'estudios' => ['nullable', 'string', 'max:100'],
            'publico_privado' => ['nullable', 'string', 'max:20'],
            'nombre' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'email'],
        ]);

        $user = Auth::user();

        if (! $user) {
            abort(403, 'Debe iniciar sesión para crear el representante legal.');
        }

        $numeroDoc = $validated['numero_doc'];
        $nombreUsuario = $validated['nombre'] ?? $user->name;
        $apellido = $validated['apellido'] ?? '';

        DB::transaction(function () use ($numeroDoc, $nombreUsuario, $apellido, $validated) {
            Usuario::updateOrCreate(
                ['numero_doc' => $numeroDoc],
                [
                    'tipo_doc' => 'CC',
                    'id_tipo_persona' => 1,
                    'nombre' => $nombreUsuario,
                    'apellido' => $apellido,
                    'estado' => true,
                    'fecha_registro' => now()->toDateString(),
                ]
            );

            Curriculum::create([
                'anio_inicio' => $validated['anio_inicio'] ?? null,
                'anio_fin' => $validated['anio_fin'] ?? null,
                'eventos_realizados' => $validated['eventos_realizados'] ?? null,
                'titulo_obtenido' => $validated['titulo_obtenido'] ?? null,
                'habilidades_principales' => $validated['habilidades_principales'] ?? null,
                'academia_formacion' => $validated['academia_formacion'] ?? null,
                'estudios' => $validated['estudios'] ?? null,
                'publico_privado' => $validated['publico_privado'] ?? null,
                'numero_doc' => $numeroDoc,
            ]);
        });

        return redirect()->route('dash.rep')->with('success', 'Representante legal creado correctamente.');
    }

    public function show(Curriculum $curriculum): JsonResponse
    {
        return response()->json(['data' => $curriculum]);
    }

    public function update(Request $request, Curriculum $curriculum): JsonResponse
    {
        $validated = $request->validate([
            'anio_inicio' => ['sometimes', 'nullable', 'integer'],
            'anio_fin' => ['sometimes', 'nullable', 'integer'],
            'eventos_realizados' => ['sometimes', 'nullable', 'integer'],
            'titulo_obtenido' => ['sometimes', 'nullable', 'string'],
            'habilidades_principales' => ['sometimes', 'nullable', 'string', 'max:150'],
            'academia_formacion' => ['sometimes', 'nullable', 'string', 'max:50'],
            'estudios' => ['sometimes', 'nullable', 'string', 'max:100'],
            'publico_privado' => ['sometimes', 'nullable', 'string', 'max:20'],
            'numero_doc' => ['sometimes', 'nullable', 'digits:10', 'exists:usuario,numero_doc'],
        ]);

        $curriculum->update($validated);

        return response()->json(['data' => $curriculum->fresh()]);
    }

    public function destroy(Curriculum $curriculum): JsonResponse
    {
        $curriculum->delete();

        return response()->json(status: 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
            'numero_doc' => ['nullable', 'string', 'max:10', 'exists:usuario,numero_doc'],
        ]);

        $curriculum = Curriculum::create($validated);

        return response()->json(['data' => $curriculum], 201);
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
            'numero_doc' => ['sometimes', 'nullable', 'string', 'max:10', 'exists:usuario,numero_doc'],
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

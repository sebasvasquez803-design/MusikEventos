<?php

namespace App\Http\Controllers;

use App\Models\ExperienciaLaboral;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExperienciaLaboralController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => ExperienciaLaboral::query()->latest('id_experiencia')->paginate(15),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'numero_doc' => ['nullable', 'string', 'max:10', 'exists:usuario,numero_doc'],
            'anio_inicio' => ['nullable', 'date'],
            'anio_fin' => ['nullable', 'integer'],
            'titulo_obtenido' => ['nullable', 'string'],
            'habilidades_principales' => ['nullable', 'string', 'max:150'],
            'academia_formacion' => ['nullable', 'string', 'max:50'],
            'estudios' => ['nullable', 'string', 'max:150'],
            'publico_privado' => ['nullable', 'boolean'],
        ]);

        $experiencia = ExperienciaLaboral::create($validated);

        return response()->json(['data' => $experiencia], 201);
    }

    public function show(ExperienciaLaboral $experienciaLaboral): JsonResponse
    {
        return response()->json(['data' => $experienciaLaboral]);
    }

    public function update(Request $request, ExperienciaLaboral $experienciaLaboral): JsonResponse
    {
        $validated = $request->validate([
            'numero_doc' => ['sometimes', 'nullable', 'string', 'max:10', 'exists:usuario,numero_doc'],
            'anio_inicio' => ['sometimes', 'nullable', 'date'],
            'anio_fin' => ['sometimes', 'nullable', 'integer'],
            'titulo_obtenido' => ['sometimes', 'nullable', 'string'],
            'habilidades_principales' => ['sometimes', 'nullable', 'string', 'max:150'],
            'academia_formacion' => ['sometimes', 'nullable', 'string', 'max:50'],
            'estudios' => ['sometimes', 'nullable', 'string', 'max:150'],
            'publico_privado' => ['sometimes', 'nullable', 'boolean'],
        ]);

        $experienciaLaboral->update($validated);

        return response()->json(['data' => $experienciaLaboral->fresh()]);
    }

    public function destroy(ExperienciaLaboral $experienciaLaboral): JsonResponse
    {
        $experienciaLaboral->delete();

        return response()->json(status: 204);
    }
}

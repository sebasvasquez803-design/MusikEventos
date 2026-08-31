<?php

namespace App\Http\Controllers;

use App\Models\PaqueteGrupo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaqueteGrupoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => PaqueteGrupo::query()->latest('id_paquete')->paginate(15),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nombre_paquete' => ['nullable', 'string', 'max:50'],
            'contenido' => ['nullable', 'string'],
            'descripcion' => ['nullable', 'string'],
            'precio' => ['nullable', 'numeric'],
            'duracion' => ['nullable', 'date_format:H:i:s'],
            'nit' => ['nullable', 'integer', 'exists:grupo_musical,nit'],
        ]);

        $paquete = PaqueteGrupo::create($validated);

        return response()->json(['data' => $paquete], 201);
    }

    public function show(PaqueteGrupo $paqueteGrupo): JsonResponse
    {
        return response()->json(['data' => $paqueteGrupo]);
    }

    public function update(Request $request, PaqueteGrupo $paqueteGrupo): JsonResponse
    {
        $validated = $request->validate([
            'nombre_paquete' => ['sometimes', 'nullable', 'string', 'max:50'],
            'contenido' => ['sometimes', 'nullable', 'string'],
            'descripcion' => ['sometimes', 'nullable', 'string'],
            'precio' => ['sometimes', 'nullable', 'numeric'],
            'duracion' => ['sometimes', 'nullable', 'date_format:H:i:s'],
            'nit' => ['sometimes', 'nullable', 'integer', 'exists:grupo_musical,nit'],
        ]);

        $paqueteGrupo->update($validated);

        return response()->json(['data' => $paqueteGrupo->fresh()]);
    }

    public function destroy(PaqueteGrupo $paqueteGrupo): JsonResponse
    {
        $paqueteGrupo->delete();

        return response()->json(status: 204);
    }
}

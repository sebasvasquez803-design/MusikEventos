<?php

namespace App\Http\Controllers;

use App\Models\GrupoMusical;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GrupoMusicalController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => GrupoMusical::query()->latest('nit')->paginate(15),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nit' => ['required', 'integer', 'unique:grupo_musical,nit'],
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
            'nit' => ['sometimes', 'required', 'integer', 'unique:grupo_musical,nit,' . $grupoMusical->nit . ',nit'],
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

<?php

namespace App\Http\Controllers;

use App\Models\Subgenero;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubgeneroController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Subgenero::query()->latest('id_subgenero')->paginate(15),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nombre_subgenero' => ['nullable', 'string', 'max:50'],
            'id_genero' => ['nullable', 'integer', 'exists:genero,id_genero'],
            'numero_doc' => ['nullable', 'string', 'max:10', 'exists:usuario,numero_doc'],
            'nit' => ['nullable', 'integer', 'exists:grupo_musical,nit'],
        ]);

        $subgenero = Subgenero::create($validated);

        return response()->json(['data' => $subgenero], 201);
    }

    public function show(Subgenero $subgenero): JsonResponse
    {
        return response()->json(['data' => $subgenero]);
    }

    public function update(Request $request, Subgenero $subgenero): JsonResponse
    {
        $validated = $request->validate([
            'nombre_subgenero' => ['sometimes', 'nullable', 'string', 'max:50'],
            'id_genero' => ['sometimes', 'nullable', 'integer', 'exists:genero,id_genero'],
            'numero_doc' => ['sometimes', 'nullable', 'string', 'max:10', 'exists:usuario,numero_doc'],
            'nit' => ['sometimes', 'nullable', 'integer', 'exists:grupo_musical,nit'],
        ]);

        $subgenero->update($validated);

        return response()->json(['data' => $subgenero->fresh()]);
    }

    public function destroy(Subgenero $subgenero): JsonResponse
    {
        $subgenero->delete();

        return response()->json(status: 204);
    }
}

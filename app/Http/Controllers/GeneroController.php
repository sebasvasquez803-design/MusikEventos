<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Genero::query()->latest('id_genero')->paginate(15),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nombre_genero' => ['required', 'string', 'max:50'],
        ]);

        $genero = Genero::create($validated);

        return response()->json(['data' => $genero], 201);
    }

    public function show(Genero $genero): JsonResponse
    {
        return response()->json(['data' => $genero]);
    }

    public function update(Request $request, Genero $genero): JsonResponse
    {
        $validated = $request->validate([
            'nombre_genero' => ['sometimes', 'required', 'string', 'max:50'],
        ]);

        $genero->update($validated);

        return response()->json(['data' => $genero->fresh()]);
    }

    public function destroy(Genero $genero): JsonResponse
    {
        $genero->delete();

        return response()->json(status: 204);
    }
}

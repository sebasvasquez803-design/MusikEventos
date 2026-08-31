<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResenaController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Resena::query()->latest('id_resena')->paginate(15),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'numero_estrellas' => ['nullable', 'integer', 'min:1', 'max:5'],
            'comentario' => ['nullable', 'string'],
            'fecha' => ['nullable', 'date'],
            'numero_doc' => ['nullable', 'string', 'max:10', 'exists:usuario,numero_doc'],
        ]);

        $resena = Resena::create($validated);

        return response()->json(['data' => $resena], 201);
    }

    public function show(Resena $resena): JsonResponse
    {
        return response()->json(['data' => $resena]);
    }

    public function update(Request $request, Resena $resena): JsonResponse
    {
        $validated = $request->validate([
            'numero_estrellas' => ['sometimes', 'nullable', 'integer', 'min:1', 'max:5'],
            'comentario' => ['sometimes', 'nullable', 'string'],
            'fecha' => ['sometimes', 'nullable', 'date'],
            'numero_doc' => ['sometimes', 'nullable', 'string', 'max:10', 'exists:usuario,numero_doc'],
        ]);

        $resena->update($validated);

        return response()->json(['data' => $resena->fresh()]);
    }

    public function destroy(Resena $resena): JsonResponse
    {
        $resena->delete();

        return response()->json(status: 204);
    }
}

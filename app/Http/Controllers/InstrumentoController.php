<?php

namespace App\Http\Controllers;

use App\Models\Instrumento;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InstrumentoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Instrumento::query()->latest('id_instrumento')->paginate(15),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nombre_instrumento' => ['nullable', 'string', 'max:500'],
            'descripcion' => ['nullable', 'string'],
            'tipo_instrumento' => ['required', 'string'],
        ]);

        $instrumento = Instrumento::create($validated);

        return response()->json(['data' => $instrumento], 201);
    }

    public function show(Instrumento $instrumento): JsonResponse
    {
        return response()->json(['data' => $instrumento]);
    }

    public function update(Request $request, Instrumento $instrumento): JsonResponse
    {
        $validated = $request->validate([
            'nombre_instrumento' => ['sometimes', 'nullable', 'string', 'max:500'],
            'descripcion' => ['sometimes', 'nullable', 'string'],
            'tipo_instrumento' => ['sometimes', 'required', 'string'],
        ]);

        $instrumento->update($validated);

        return response()->json(['data' => $instrumento->fresh()]);
    }

    public function destroy(Instrumento $instrumento): JsonResponse
    {
        $instrumento->delete();

        return response()->json(status: 204);
    }
}

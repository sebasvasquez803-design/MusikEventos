<?php

namespace App\Http\Controllers;

use App\Models\TipoPersona;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TipoPersonaController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => TipoPersona::query()->latest('id_tipo_persona')->paginate(15),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nombre_tipo' => ['required', 'string', 'max:50'],
        ]);

        $tipoPersona = TipoPersona::create($validated);

        return response()->json(['data' => $tipoPersona], 201);
    }

    public function show(TipoPersona $tipoPersona): JsonResponse
    {
        return response()->json(['data' => $tipoPersona]);
    }

    public function update(Request $request, TipoPersona $tipoPersona): JsonResponse
    {
        $validated = $request->validate([
            'nombre_tipo' => ['sometimes', 'required', 'string', 'max:50'],
        ]);

        $tipoPersona->update($validated);

        return response()->json(['data' => $tipoPersona->fresh()]);
    }

    public function destroy(TipoPersona $tipoPersona): JsonResponse
    {
        $tipoPersona->delete();

        return response()->json(status: 204);
    }
}

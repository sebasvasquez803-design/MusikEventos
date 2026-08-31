<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Reserva::query()->latest('id_reserva')->paginate(15),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'fecha' => ['nullable', 'date'],
            'hora' => ['nullable', 'date_format:H:i:s'],
            'direccion' => ['nullable', 'string', 'max:60'],
            'valor' => ['nullable', 'numeric'],
            'estado' => ['nullable', 'string'],
            'numero_doc' => ['nullable', 'string', 'max:10', 'exists:usuario,numero_doc'],
            'nit' => ['nullable', 'integer', 'exists:grupo_musical,nit'],
        ]);

        $reserva = Reserva::create($validated);

        return response()->json(['data' => $reserva], 201);
    }

    public function show(Reserva $reserva): JsonResponse
    {
        return response()->json(['data' => $reserva]);
    }

    public function update(Request $request, Reserva $reserva): JsonResponse
    {
        $validated = $request->validate([
            'fecha' => ['sometimes', 'nullable', 'date'],
            'hora' => ['sometimes', 'nullable', 'date_format:H:i:s'],
            'direccion' => ['sometimes', 'nullable', 'string', 'max:60'],
            'valor' => ['sometimes', 'nullable', 'numeric'],
            'estado' => ['sometimes', 'nullable', 'string'],
            'numero_doc' => ['sometimes', 'nullable', 'string', 'max:10', 'exists:usuario,numero_doc'],
            'nit' => ['sometimes', 'nullable', 'integer', 'exists:grupo_musical,nit'],
        ]);

        $reserva->update($validated);

        return response()->json(['data' => $reserva->fresh()]);
    }

    public function destroy(Reserva $reserva): JsonResponse
    {
        $reserva->delete();

        return response()->json(status: 204);
    }
}

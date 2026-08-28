<?php

namespace App\Http\Controllers;

use App\Models\DetallePago;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DetallePagoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => DetallePago::query()->latest('numero_serie')->paginate(15),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'fecha_pago' => ['nullable', 'date'],
            'precio_total' => ['nullable', 'numeric'],
            'precio_con_iva' => ['nullable', 'numeric'],
            'descuento' => ['nullable', 'numeric'],
            'estado_pago' => ['nullable', 'boolean'],
            'id_cliente' => ['nullable', 'integer'],
            'id_reserva' => ['nullable', 'integer', 'exists:reserva,id_reserva'],
        ]);

        $detallePago = DetallePago::create($validated);

        return response()->json(['data' => $detallePago], 201);
    }

    public function show(DetallePago $detallePago): JsonResponse
    {
        return response()->json(['data' => $detallePago]);
    }

    public function update(Request $request, DetallePago $detallePago): JsonResponse
    {
        $validated = $request->validate([
            'fecha_pago' => ['sometimes', 'nullable', 'date'],
            'precio_total' => ['sometimes', 'nullable', 'numeric'],
            'precio_con_iva' => ['sometimes', 'nullable', 'numeric'],
            'descuento' => ['sometimes', 'nullable', 'numeric'],
            'estado_pago' => ['sometimes', 'nullable', 'boolean'],
            'id_cliente' => ['sometimes', 'nullable', 'integer'],
            'id_reserva' => ['sometimes', 'nullable', 'integer', 'exists:reserva,id_reserva'],
        ]);

        $detallePago->update($validated);

        return response()->json(['data' => $detallePago->fresh()]);
    }

    public function destroy(DetallePago $detallePago): JsonResponse
    {
        $detallePago->delete();

        return response()->json(status: 204);
    }
}

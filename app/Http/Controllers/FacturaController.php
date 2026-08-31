<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Factura::query()->latest('id_factura')->paginate(15),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'numero_serie' => ['nullable', 'integer', 'exists:detalle_pago,numero_serie'],
        ]);

        $factura = Factura::create($validated);

        return response()->json(['data' => $factura], 201);
    }

    public function show(Factura $factura): JsonResponse
    {
        return response()->json(['data' => $factura]);
    }

    public function update(Request $request, Factura $factura): JsonResponse
    {
        $validated = $request->validate([
            'numero_serie' => ['sometimes', 'nullable', 'integer', 'exists:detalle_pago,numero_serie'],
        ]);

        $factura->update($validated);

        return response()->json(['data' => $factura->fresh()]);
    }

    public function destroy(Factura $factura): JsonResponse
    {
        $factura->delete();

        return response()->json(status: 204);
    }
}

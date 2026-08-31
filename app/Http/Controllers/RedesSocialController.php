<?php

namespace App\Http\Controllers;

use App\Models\RedesSocial;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RedesSocialController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => RedesSocial::query()->latest('id_red_social')->paginate(15),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nombre_red' => ['nullable', 'string', 'max:25'],
            'url' => ['nullable', 'url'],
            'numero_doc' => ['nullable', 'string', 'max:10', 'exists:usuario,numero_doc'],
        ]);

        $redSocial = RedesSocial::create($validated);

        return response()->json(['data' => $redSocial], 201);
    }

    public function show(RedesSocial $redesSocial): JsonResponse
    {
        return response()->json(['data' => $redesSocial]);
    }

    public function update(Request $request, RedesSocial $redesSocial): JsonResponse
    {
        $validated = $request->validate([
            'nombre_red' => ['sometimes', 'nullable', 'string', 'max:25'],
            'url' => ['sometimes', 'nullable', 'url'],
            'numero_doc' => ['sometimes', 'nullable', 'string', 'max:10', 'exists:usuario,numero_doc'],
        ]);

        $redesSocial->update($validated);

        return response()->json(['data' => $redesSocial->fresh()]);
    }

    public function destroy(RedesSocial $redesSocial): JsonResponse
    {
        $redesSocial->delete();

        return response()->json(status: 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

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
            'nit' => ['nullable', 'string', 'max:10', 'exists:grupo_musical,nit'],
            'nombre_usuario' => ['nullable', 'string', 'max:80'],
        ]);

        $resena = Resena::create($validated);

        return response()->json(['data' => $resena], 201);
    }

    public function storeFromForm(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'nit' => ['required', 'string', 'exists:grupo_musical,nit'],
            'nombre_usuario' => ['required', 'string', 'max:80'],
            'comentario' => ['required', 'string', 'max:300'],
            'numero_estrellas' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        Resena::create([
            'nit' => $validated['nit'],
            'nombre_usuario' => $validated['nombre_usuario'],
            'comentario' => $validated['comentario'],
            'numero_estrellas' => $validated['numero_estrellas'],
            'fecha' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'Tu reseña fue enviada correctamente.');
    }

    public function updateFromForm(Request $request, Resena $resena): RedirectResponse
    {
        abort_unless(auth()->user()?->canManageMusicalGroups(), 403);

        $validated = $request->validate([
            'nombre_usuario' => ['required', 'string', 'max:80'],
            'comentario' => ['required', 'string', 'max:300'],
            'numero_estrellas' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        $resena->update([
            'nombre_usuario' => $validated['nombre_usuario'],
            'comentario' => $validated['comentario'],
            'numero_estrellas' => $validated['numero_estrellas'],
        ]);

        return redirect()->back()->with('success', 'Reseña actualizada correctamente.');
    }

    public function destroyFromForm(Resena $resena): RedirectResponse
    {
        abort_unless(auth()->user()?->canManageMusicalGroups(), 403);

        $resena->delete();

        return redirect()->back()->with('success', 'Reseña eliminada correctamente.');
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

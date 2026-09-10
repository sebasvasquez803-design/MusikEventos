<?php

namespace App\Http\Controllers;

use App\Models\GrupoMusical;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GrupoMusicalController extends Controller
{
    public function home()
    {
        return view('index1', [
            'grupos' => GrupoMusical::query()->latest('nit')->get(),
        ]);
    }

    public function storeFromForm(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nit' => ['required', 'integer', 'unique:grupo_musical,nit'],
            'nombre_grupo' => ['required', 'string', 'max:50'],
            'telefono' => ['required', 'string', 'max:10'],
            'email' => ['required', 'email', 'max:50'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'descripcion' => ['nullable', 'string', 'max:500'],
            'numero_doc' => ['nullable', 'string', 'max:10', 'exists:usuario,numero_doc'],
            'precio_hora' => ['nullable', 'numeric'],
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('grupos', 'public');
        }

        $grupoMusical = new GrupoMusical();
        $grupoMusical->fill($validated);
        $grupoMusical->save();

        return redirect()->route('home')->with([
            'success' => 'Grupo musical registrado correctamente.',
            'grupoMusical' => $grupoMusical,
        ]);
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => GrupoMusical::query()->latest('nit')->paginate(15),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nit' => ['required', 'integer', 'unique:grupo_musical,nit'],
            'nombre_grupo' => ['nullable', 'string', 'max:50'],
            'telefono' => ['nullable', 'string', 'max:10'],
            'email' => ['nullable', 'email', 'max:50'],
            'avatar' => ['nullable', 'string'],
            'descripcion' => ['nullable', 'string'],
            'numero_doc' => ['nullable', 'string', 'max:10', 'exists:usuario,numero_doc'],
            'precio_hora' => ['nullable', 'numeric'],
        ]);

        $grupoMusical = GrupoMusical::create($validated);

        return response()->json(['data' => $grupoMusical], 201);
    }

    public function show(GrupoMusical $grupoMusical): JsonResponse
    {
        return response()->json(['data' => $grupoMusical]);
    }

    public function update(Request $request, GrupoMusical $grupoMusical): JsonResponse
    {
        $validated = $request->validate([
            'nit' => ['sometimes', 'required', 'integer', 'unique:grupo_musical,nit,' . $grupoMusical->nit . ',nit'],
            'nombre_grupo' => ['sometimes', 'nullable', 'string', 'max:50'],
            'telefono' => ['sometimes', 'nullable', 'string', 'max:10'],
            'email' => ['sometimes', 'nullable', 'email', 'max:50'],
            'avatar' => ['sometimes', 'nullable', 'string'],
            'descripcion' => ['sometimes', 'nullable', 'string'],
            'numero_doc' => ['sometimes', 'nullable', 'string', 'max:10', 'exists:usuario,numero_doc'],
            'precio_hora' => ['sometimes', 'nullable', 'numeric'],
        ]);

        $grupoMusical->update($validated);

        return response()->json(['data' => $grupoMusical->fresh()]);
    }

    public function destroy(GrupoMusical $grupoMusical): JsonResponse
    {
        $grupoMusical->delete();

        return response()->json(status: 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Usuario::query()->latest('id_usuario')->paginate(15),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'tipo_doc' => ['nullable', 'string', 'max:5'],
            'numero_doc' => ['nullable', 'string', 'max:10', 'unique:usuario,numero_doc'],
            'id_tipo_persona' => ['nullable', 'integer', 'exists:tipo_persona,id_tipo_persona'],
            'nombre' => ['nullable', 'string', 'max:25'],
            'apellido' => ['nullable', 'string', 'max:25'],
            'sexo' => ['nullable', 'string', 'max:1'],
            'celular' => ['nullable', 'string', 'max:10'],
            'fecha_nacimiento' => ['nullable', 'date'],
            'avatar' => ['nullable', 'string'],
            'estado' => ['nullable', 'boolean'],
            'fecha_registro' => ['nullable', 'date'],
            'nombre_artistico' => ['nullable', 'string', 'max:25'],
        ]);

        $usuario = Usuario::create($validated);

        return response()->json(['data' => $usuario], 201);
    }

    public function show(Usuario $usuario): JsonResponse
    {
        return response()->json(['data' => $usuario]);
    }

    public function update(Request $request, Usuario $usuario): JsonResponse
    {
        $validated = $request->validate([
            'tipo_doc' => ['sometimes', 'nullable', 'string', 'max:5'],
            'numero_doc' => ['sometimes', 'nullable', 'string', 'max:10', 'unique:usuario,numero_doc,' . $usuario->id_usuario . ',id_usuario'],
            'id_tipo_persona' => ['sometimes', 'nullable', 'integer', 'exists:tipo_persona,id_tipo_persona'],
            'nombre' => ['sometimes', 'nullable', 'string', 'max:25'],
            'apellido' => ['sometimes', 'nullable', 'string', 'max:25'],
            'sexo' => ['sometimes', 'nullable', 'string', 'max:1'],
            'celular' => ['sometimes', 'nullable', 'string', 'max:10'],
            'fecha_nacimiento' => ['sometimes', 'nullable', 'date'],
            'avatar' => ['sometimes', 'nullable', 'string'],
            'estado' => ['sometimes', 'nullable', 'boolean'],
            'fecha_registro' => ['sometimes', 'nullable', 'date'],
            'nombre_artistico' => ['sometimes', 'nullable', 'string', 'max:25'],
        ]);

        $usuario->update($validated);

        return response()->json(['data' => $usuario->fresh()]);
    }

    public function destroy(Usuario $usuario): JsonResponse
    {
        $usuario->delete();

        return response()->json(status: 204);
    }
}

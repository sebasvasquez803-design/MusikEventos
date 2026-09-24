<?php

namespace App\Http\Controllers;

use App\Models\Subgenero;
use Illuminate\Http\Request;

class SubgeneroController extends Controller
{
    // index(): muestra todos los subgéneros y permite buscar por ID.
    public function index(Request $request)
    {
        $query = Subgenero::query();

        if ($request->filled('id')) {
            $query->where('id_subgenero', $request->id);
        }

        $subgeneros = $query->get();

        return view('CRUD.subgeneros.index', compact('subgeneros'));
    }

    // create(): muestra el formulario para crear un nuevo subgénero.
    public function create()
    {
        return view('CRUD.subgeneros.create');
    }

    // store(): valida y guarda el nuevo subgénero relacionado con un género.
    public function store(Request $request)
    {
        $request->validate([
            'nombre_subgenero' => 'required|string|max:100',
            'id_genero' => 'required|exists:genero,id_genero',
        ]);

        Subgenero::create([
            'nombre_subgenero' => $request->nombre_subgenero,
            'id_genero' => $request->id_genero,
        ]);

        return redirect()->route('sub-generos.index');
    }

    // edit(): carga el subgénero que se quiere modificar.
    public function edit(Subgenero $subgenero)
    {
        return view('CRUD.subgeneros.edit', compact('subgenero'));
    }

    // update(): guarda los cambios del subgénero actual.
    public function update(Request $request, Subgenero $subgenero)
    {
        $request->validate([
            'nombre_subgenero' => 'required|string|max:100',
            'id_genero' => 'required|exists:genero,id_genero',
        ]);

        $subgenero->update([
            'nombre_subgenero' => $request->nombre_subgenero,
            'id_genero' => $request->id_genero,
        ]);

        return redirect()->route('sub-generos.index');
    }

    // destroy(): elimina el subgénero seleccionado.
    public function destroy(Subgenero $subgenero)
    {
        $subgenero->delete();

        return redirect()->route('sub-generos.index');
    }
}
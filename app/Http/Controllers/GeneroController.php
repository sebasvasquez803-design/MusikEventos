<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    // index(): lista los géneros y permite filtrar por ID desde la búsqueda.
    public function index(Request $request)
    {
        $query = Genero::query();

        // Si llega un id en la URL, filtramos por ese valor.
        if ($request->filled('id')) {
            $query->where('id_genero', $request->id);
        }

        // Traemos el resultado final para mostrarlos en la vista.
        $generos = $query->get();

        // Retornamos la vista de Blade con la lista.
        return view('CRUD.generos.index', compact('generos'));
    }

    // create(): muestra el formulario para registrar un nuevo género.
    public function create()
    {
        return view('CRUD.generos.create');
    }

    // store(): guarda el género enviado por el formulario.
    public function store(Request $request)
    {
        $request->validate([
            'nombre_genero' => 'required|string|max:100',
        ]);

        Genero::create([
            'nombre_genero' => $request->nombre_genero,
        ]);

        return redirect()->route('generos.index');
    }

    // edit(): carga el registro que se desea editar.
    public function edit(Genero $genero)
    {
        return view('CRUD.generos.edit', compact('genero'));
    }

    // update(): recibe los cambios y los guarda en la fila actual.
    public function update(Request $request, Genero $genero)
    {
        $request->validate([
            'nombre_genero' => 'required|string|max:100',
        ]);

        $genero->update([
            'nombre_genero' => $request->nombre_genero,
        ]);

        return redirect()->route('generos.index');
    }

    // destroy(): elimina el género seleccionado.
    public function destroy(Genero $genero)
    {
        $genero->delete();

        return redirect()->route('generos.index');
    }
}
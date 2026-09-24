<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Models\GrupoMusical;
use App\Models\Subgenero;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PanelAdminController extends Controller
{
    public function index(Request $request)
    {
        $entidad = $request->input('entidad');
        $nombre = trim((string) $request->input('nombre'));
        $buscarNombre = $nombre !== '' ? "{$nombre}%" : null;
        $mostrar = $request->input('mostrar');
        $limitar = fn ($query, string $tipo) => $query->when($mostrar !== $tipo, fn ($query) => $query->take(5));

        $generos = $limitar(Genero::query()
            ->when($entidad === 'genero' && $buscarNombre, fn ($query) => $query->where('nombre_genero', 'like', $buscarNombre))
            ->latest('id_genero'), 'genero')->get();
        $subgeneros = $limitar(Subgenero::query()
            ->when($entidad === 'subgenero' && $buscarNombre, fn ($query) => $query->where('nombre_subgenero', 'like', $buscarNombre))
            ->latest('id_subgenero'), 'subgenero')->get();
        $clientes = $limitar(Usuario::query()
            ->where('id_tipo_persona', 3)
            ->when($entidad === 'cliente' && $buscarNombre, fn ($query) => $query->where(function ($query) use ($buscarNombre) {
                $query->where('nombre', 'like', $buscarNombre)
                    ->orWhere('apellido', 'like', $buscarNombre);
            }))
            ->latest('id_usuario'), 'cliente')->get();
        $grupos = $limitar(GrupoMusical::query()
            ->when($entidad === 'grupo' && $buscarNombre, fn ($query) => $query->where('nombre_grupo', 'like', $buscarNombre))
            ->latest('nit'), 'grupo')->get();
        $representantes = $limitar(Usuario::query()
            ->where('id_tipo_persona', 1)
            ->when($entidad === 'representante' && $buscarNombre, fn ($query) => $query->where(function ($query) use ($buscarNombre) {
                $query->where('nombre', 'like', $buscarNombre)
                    ->orWhere('apellido', 'like', $buscarNombre);
            }))
            ->latest('id_usuario'), 'representante')->get();
        $artistas = $limitar(Usuario::query()
            ->where('id_tipo_persona', 2)
            ->when($entidad === 'artista' && $buscarNombre, fn ($query) => $query->where(function ($query) use ($buscarNombre) {
                $query->where('nombre', 'like', $buscarNombre)
                    ->orWhere('apellido', 'like', $buscarNombre)
                    ->orWhere('nombre_artistico', 'like', $buscarNombre);
            }))
            ->latest('id_usuario'), 'artista')->get();

        return view('panel_admin', compact(
            'generos',
            'subgeneros',
            'clientes',
            'grupos',
            'representantes',
            'artistas',
            'entidad',
            'nombre',
            'mostrar',
        ));
    }
}


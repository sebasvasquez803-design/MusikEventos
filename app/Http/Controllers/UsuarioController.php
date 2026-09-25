<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // index(): lista usuarios y permite filtrar por ID o por tipo de persona.
    // Esto sirve para separar clientes, representantes legales y artistas solistas.
    public function index(Request $request)
    {
        $query = Usuario::query();
    
        if ($request->filled('id')) {
            $query->where('id_usuario', $request->id);
        }
    
        // Si viene tipo_persona en la URL, solo muestra ese tipo de usuario.
        if ($request->filled('tipo_persona')) {
            $query->where('id_tipo_persona', $request->tipo_persona);
        }
    
        $usuarios = $query->get();
    
        return view('CRUD.usuarios.index', compact('usuarios'));
    }

    public function registerArtista(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $numeroDoc = $request->input('numero_doc') ?: str_pad((string) $user->id, 10, '0', STR_PAD_LEFT);

        Usuario::create([
            'tipo_doc' => 'CC',
            'numero_doc' => $numeroDoc,
            'id_tipo_persona' => 2,
            'nombre' => $validated['name'],
            'apellido' => $request->input('apellido'),
            'estado' => true,
            'fecha_registro' => now()->toDateString(),
        ]);

        Auth::login($user);

        return redirect()->route('dash.rep');
    }

    // create(): muestra el formulario para crear un usuario nuevo.
    public function create()
    {
        return view('CRUD.usuarios.create');
    }

    // store(): valida y guarda un usuario desde el formulario del panel.
    public function store(Request $request)
    {
        $request->validate([
            'tipo_doc' => 'nullable|string|max:5',
            'numero_doc' => 'nullable|string|max:10|unique:usuario,numero_doc',
            'id_tipo_persona' => 'nullable|integer|exists:tipo_persona,id_tipo_persona',
            'nombre' => 'nullable|string|max:25',
            'apellido' => 'nullable|string|max:25',
            'sexo' => 'nullable|string|max:1',
            'celular' => 'nullable|string|max:10',
            'fecha_nacimiento' => 'nullable|date',
            'avatar' => 'nullable|string',
            'estado' => 'nullable|boolean',
            'fecha_registro' => 'nullable|date',
            'nombre_artistico' => 'nullable|string|max:25',
        ]);

        Usuario::create($request->all());

        return redirect()->route('usuarios.index');
    }

    // edit(): carga a un usuario específico para modificarlo.
    public function edit(Usuario $usuario)
    {
        return view('CRUD.usuarios.edit', compact('usuario'));
    }

    // update(): actualiza los datos del usuario que se está editando.
    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'tipo_doc' => 'nullable|string|max:5',
            'numero_doc' => 'nullable|string|max:10|unique:usuario,numero_doc,' . $usuario->id_usuario . ',id_usuario',
            'id_tipo_persona' => 'nullable|integer|exists:tipo_persona,id_tipo_persona',
            'nombre' => 'nullable|string|max:25',
            'apellido' => 'nullable|string|max:25',
            'sexo' => 'nullable|string|max:1',
            'celular' => 'nullable|string|max:10',
            'fecha_nacimiento' => 'nullable|date',
            'avatar' => 'nullable|string',
            'estado' => 'nullable|boolean',
            'fecha_registro' => 'nullable|date',
            'nombre_artistico' => 'nullable|string|max:25',
        ]);

        $usuario->update($request->all());

        return redirect()->route('usuarios.index');
    }

    // destroy(): elimina un usuario del sistema.
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index');
    }
}
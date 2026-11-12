<?php

namespace App\Http\Controllers;

use App\Actions\Teams\CreateTeam;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RepresentanteLegalRegistrationController extends Controller
{
    public function create(): View
    {
        return view('formularios.registro_representante');
    }

    public function store(Request $request, CreateTeam $createTeam): RedirectResponse
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:25'],
            'apellido' => ['required', 'string', 'max:25'],
            'tipo_doc' => ['required', 'string', 'in:CC,CE,TI,PAS'],
            'numero_doc' => ['required', 'string', 'max:10', 'unique:usuario,numero_doc'],
            'celular' => ['required', 'digits:10'],
            'fecha_nacimiento' => ['required', 'date', 'before:today'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = DB::transaction(function () use ($validated, $createTeam): User {
            $user = User::create([
                'name' => trim($validated['nombre'].' '.$validated['apellido']),
                'email' => $validated['email'],
                'password' => $validated['password'],
            ]);

            $createTeam->handle($user, 'Equipo de '.$user->name, isPersonal: true);

            Usuario::create([
                'user_id' => $user->id,
                'tipo_doc' => $validated['tipo_doc'],
                'numero_doc' => $validated['numero_doc'],
                'id_tipo_persona' => 1,
                'nombre' => $validated['nombre'],
                'apellido' => $validated['apellido'],
                'celular' => $validated['celular'],
                'fecha_nacimiento' => $validated['fecha_nacimiento'],
                'estado' => true,
                'fecha_registro' => now()->toDateString(),
            ]);

            return $user;
        });

        if (! $request->user()) {
            Auth::login($user);
            $request->session()->regenerate();
        }

        return redirect()
            ->route('dash.rep')
            ->with('success', 'Cuenta de representante legal creada correctamente.');
    }
}
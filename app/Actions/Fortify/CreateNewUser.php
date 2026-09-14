<?php

namespace App\Actions\Fortify;

// Acción encargada de validar y crear nuevos usuarios mediante Fortify.
use App\Actions\Teams\CreateTeam;
use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

// Implementa el proceso de registro utilizado por Laravel Fortify.
class CreateNewUser implements CreatesNewUsers
{
    // Reutiliza las reglas de validación del perfil y de las contraseñas.
    use PasswordValidationRules, ProfileValidationRules;

    // Recibe la acción que crea el equipo personal del usuario.
    public function __construct(private CreateTeam $createTeam)
    {
        //
    }

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // Valida los datos enviados desde el formulario de registro.
        Validator::make($input, [
            ...$this->profileRules(),
            'password' => $this->passwordRules(),
        ])->validate();

        // Ejecuta el registro dentro de una transacción para mantener
        // consistentes el usuario y su equipo personal.
        return DB::transaction(function () use ($input) {
            // Crea el usuario con su nombre, correo y contraseña.
            // El modelo User cifra automáticamente la contraseña.
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => $input['password'],
            ]);

            // Crea un equipo personal asociado al nuevo usuario.
            $this->createTeam->handle($user, $user->name."'s Team", isPersonal: true);

            // Devuelve el usuario recién creado para completar el login.
            return $user;
        });
    }
}

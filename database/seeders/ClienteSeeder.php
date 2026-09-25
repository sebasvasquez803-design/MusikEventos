<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            ['numero_doc' => '1000000001', 'nombre' => 'Laura', 'apellido' => 'Gomez', 'sexo' => 'F', 'celular' => '3100000001', 'email' => 'laura.gomez@gmail.com', 'password' => 'cliente123'],
            ['numero_doc' => '1000000002', 'nombre' => 'Carlos', 'apellido' => 'Mendez', 'sexo' => 'M', 'celular' => '3100000002', 'email' => 'carlos.mendez@gmail.com', 'password' => 'cliente123'],
            ['numero_doc' => '1000000003', 'nombre' => 'Valentina', 'apellido' => 'Rojas', 'sexo' => 'F', 'celular' => '3100000003', 'email' => 'valentina.rojas@gmail.com', 'password' => 'cliente123'],
            ['numero_doc' => '1000000004', 'nombre' => 'Andres', 'apellido' => 'Torres', 'sexo' => 'M', 'celular' => '3100000004', 'email' => 'andres.torres@gmail.com', 'password' => 'cliente123'],
            ['numero_doc' => '1000000005', 'nombre' => 'Natalia', 'apellido' => 'Castro', 'sexo' => 'F', 'celular' => '3100000005', 'email' => 'natalia.castro@gmail.com', 'password' => 'cliente123'],
        ];

        foreach ($clientes as $cliente) {
            User::updateOrCreate(
                ['email' => $cliente['email']],
                [
                    'name' => trim($cliente['nombre'].' '.$cliente['apellido']),
                    'password' => Hash::make($cliente['password']),
                ],
            );
        }

        $this->insertarUsuarios($clientes, 3);
    }

    private function insertarUsuarios(array $usuarios, int $tipoPersona): void
    {
        $ahora = now();

        $usuarios = array_map(fn (array $usuario) => array_merge($usuario, [
            'tipo_doc' => 'CC',
            'id_tipo_persona' => $tipoPersona,
            'estado' => true,
            'fecha_registro' => $ahora->toDateString(),
            'created_at' => $ahora,
            'updated_at' => $ahora,
        ]), $usuarios);

        $usuarios = array_map(function (array $usuario) {
            unset($usuario['email'], $usuario['password']);

            return $usuario;
        }, $usuarios);

        DB::table('usuario')->upsert($usuarios, ['numero_doc'], [
            'tipo_doc',
            'id_tipo_persona',
            'nombre',
            'apellido',
            'sexo',
            'celular',
            'estado',
            'fecha_registro',
            'updated_at',
        ]);
    }
}
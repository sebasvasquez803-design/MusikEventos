<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administradores = [
            ['name' => 'Mican', 'email' => 'mican@gmail.com', 'password' => 'mican'],
            ['name' => 'JH', 'email' => 'jh@gmail.com', 'password' => 'jh'],
            ['name' => 'William', 'email' => 'william@gmail.com', 'password' => 'william'],
            ['name' => 'Sebastian', 'email' => 'sebastian@gmail.com', 'password' => 'sebastian'],
        ];

        foreach ($administradores as $administrador) {
            User::updateOrCreate(
                ['email' => $administrador['email']],
                [
                    'name' => $administrador['name'],
                    'password' => Hash::make($administrador['password']),
                ],
            );
        }
    }
}

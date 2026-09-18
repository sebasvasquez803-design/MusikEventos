<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function eventos()
        {
        return view('calendario.eventos');
    
        // Aquí puedes obtener los eventos desde tu base de datos o cualquier otra fuente.
        $eventos = [
            [
                'title' => 'Evento 1',
                'start' => '2024-07-01',
                'end' => '2024-07-02',
            ],
            [
                'title' => 'Evento 2',
                'start' => '2024-07-05',
                'end' => '2024-07-06',
            ],
            // Agrega más eventos según sea necesario
        ];

        return response()->json($eventos);
    }
}
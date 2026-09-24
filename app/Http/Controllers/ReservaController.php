<?php

namespace App\Http\Controllers;

use App\Models\GrupoMusical;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReservaController extends Controller
{
    /**
     * Lista paginada de reservas (Estructura REST).
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Reserva::query()->latest('id_reserva')->paginate(15),
        ]);
    }

    /**
     * Crear una nueva reserva (Lógica del primer controlador con respuestas tipadas JSON).
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'fecha' => ['required', 'date'],
            'hora' => ['required', 'date_format:H:i:s'],
            'direccion' => ['nullable', 'string', 'max:60'],
            'nit' => ['required', 'integer', 'exists:grupo_musical,nit'],
        ]);

        $usuario = Auth::user();

        // Validar choque de horarios (bloques de 2 horas)
        $choque = Reserva::where('nit', $validated['nit'])
            ->where('fecha', $validated['fecha'])
            ->whereRaw("ABS(TIMESTAMPDIFF(MINUTE, hora, ?)) < 120", [$validated['hora']])
            ->whereIn('estado', ['activo', 'pendiente'])
            ->exists();

        if ($choque) {
            return response()->json(['error' => 'Esa fecha y hora ya están reservadas.'], 409);
        }

        $grupo = GrupoMusical::where('nit', $validated['nit'])->first();

        // Creación con datos calculados del usuario y del grupo
        $reserva = Reserva::create([
            'fecha' => $validated['fecha'],
            'hora' => $validated['hora'],
            'direccion' => $validated['direccion'] ?? null,
            'valor' => $grupo ? $grupo->precio_hora : 0,
            'estado' => 'pendiente',
            'numero_doc' => $usuario ? $usuario->numero_doc : null,
            'nit' => $validated['nit'],
        ]);

        return response()->json([
            'message' => 'Reserva creada correctamente.',
            'data' => $reserva
        ], 201);
    }

    /**
     * Mostrar una reserva específica.
     */
    public function show(Reserva $reserva): JsonResponse
    {
        return response()->json(['data' => $reserva]);
    }

    /**
     * Actualizar datos de una reserva.
     */
    public function update(Request $request, Reserva $reserva): JsonResponse
    {
        $validated = $request->validate([
            'fecha' => ['sometimes', 'nullable', 'date'],
            'hora' => ['sometimes', 'nullable', 'date_format:H:i:s'],
            'direccion' => ['sometimes', 'nullable', 'string', 'max:60'],
            'valor' => ['sometimes', 'nullable', 'numeric'],
            'estado' => ['sometimes', 'nullable', 'string'],
            'numero_doc' => ['sometimes', 'nullable', 'string', 'max:10', 'exists:usuario,numero_doc'],
            'nit' => ['sometimes', 'nullable', 'integer', 'exists:grupo_musical,nit'],
        ]);

        $reserva->update($validated);

        return response()->json(['data' => $reserva->fresh()]);
    }

    /**
     * Eliminar una reserva.
     */
    public function destroy(Reserva $reserva): JsonResponse
    {
        $reserva->delete();

        return response()->json(null, 204);
    }

    /*
    |--------------------------------------------------------------------------
    | Métodos de Calendario y Eventos
    |--------------------------------------------------------------------------
    */

    /**
     * Eventos ocupados de un grupo (para el modal de reserva).
     */
    public function eventosBloqueados($nit): JsonResponse
    {
        $reservas = Reserva::where('nit', $nit)
            ->whereIn('estado', ['activo', 'pendiente'])
            ->get(['fecha', 'hora']);

        $eventos = $reservas->map(function ($r) {
            $inicio = $r->fecha . 'T' . $r->hora;
            $fin = Carbon::parse($inicio)->addHours(2)->toIso8601String();

            return [
                'title' => 'Ocupado',
                'start' => $inicio,
                'end' => $fin,
                'color' => '#e74c3c',
                'display' => 'background',
                'extendedProps' => ['bloqueado' => true],
            ];
        });

        return response()->json($eventos);
    }

    /**
     * Renderiza la vista principal del calendario.
     */
    public function calendarioCompleto(): View
    {
        return view('calendario');
    }

    /**
     * Devuelve los eventos según el rol del usuario para el calendario completo.
     */
    public function eventosCalendario(): JsonResponse
    {
        $usuario = Auth::user();

        if (!$usuario) {
            return response()->json([]);
        }

        $tipo = $usuario->id_tipo_persona; // 1=Rep.Legal, 2=Artista, 3=Cliente

        // Grupo musical o representante legal → eventos del grupo
        if (in_array($tipo, [1, 2])) {
            $grupo = GrupoMusical::where('numero_doc', $usuario->numero_doc)->first();

            if (!$grupo) {
                return response()->json([]);
            }

            $reservas = Reserva::where('nit', $grupo->nit)
                ->with('usuario')
                ->get();

            return response()->json($reservas->map(function ($r) {
                return [
                    'title' => 'Cliente: ' . ($r->usuario->nombre ?? 'N/A') . ' ' . ($r->usuario->apellido ?? ''),
                    'start' => $r->fecha . 'T' . $r->hora,
                    'end' => Carbon::parse($r->fecha . 'T' . $r->hora)->addHours(2)->toIso8601String(),
                    'color' => '#f39c12',
                    'extendedProps' => [
                        'estado' => $r->estado,
                        'direccion' => $r->direccion,
                    ],
                ];
            }));
        }

        // Cliente → sus propias reservas
        if ($tipo === 3) {
            $reservas = Reserva::where('numero_doc', $usuario->numero_doc)
                ->with('grupoMusical')
                ->get();

            return response()->json($reservas->map(function ($r) {
                return [
                    'title' => $r->grupoMusical->nombre_grupo ?? 'Grupo',
                    'start' => $r->fecha . 'T' . $r->hora,
                    'end' => Carbon::parse($r->fecha . 'T' . $r->hora)->addHours(2)->toIso8601String(),
                    'color' => '#2ecc71',
                    'extendedProps' => [
                        'estado' => $r->estado,
                        'direccion' => $r->direccion,
                    ],
                ];
            }));
        }

        return response()->json([]);
    }
}

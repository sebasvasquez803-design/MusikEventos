<?php

namespace App\Http\Controllers;

use App\Models\GrupoMusical;
use App\Models\Reserva;
use App\Models\DetallePago;
use App\Mail\ReservaConfirmada;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
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
            'direccion' => ['required', 'string', 'max:60'],
            'nit' => ['required', 'integer', 'exists:grupo_musical,nit'],
            'horas' => ['sometimes', 'integer', 'min:1', 'max:12'],
            'metodo_pago' => ['sometimes', 'in:card,pse,wallet'],
        ]);

        $usuario = Auth::user();
        $horaSolicitada = Carbon::createFromFormat('H:i:s', $validated['hora']);

        // Validación compatible con MySQL y SQLite.
        $reservasDelDia = Reserva::where('nit', $validated['nit'])
            ->where('fecha', $validated['fecha'])
            ->whereIn('estado', ['activo', 'pendiente'])
            ->get(['hora']);

        $choque = $reservasDelDia->contains(function (Reserva $reserva) use ($horaSolicitada) {
            if (!$reserva->hora) {
                return false;
            }

            try {
                $horaExistente = Carbon::createFromFormat('H:i:s', substr((string) $reserva->hora, 0, 8));
            } catch (\Throwable) {
                return false;
            }

            return abs($horaExistente->diffInMinutes($horaSolicitada, false)) < 120;
        });

        if ($choque) {
            return response()->json(['error' => 'Esa fecha y hora ya están reservadas.'], 409);
        }

        $grupo = GrupoMusical::where('nit', $validated['nit'])->first();
        $horas = $validated['horas'] ?? 1;
        $precioPorHora = $grupo ? (float) $grupo->precio_hora : 0;
        $total = $precioPorHora * $horas;

        $numeroDocumento = $usuario?->usuario?->numero_doc;

        $reserva = DB::transaction(function () use ($validated, $total, $numeroDocumento, $usuario) {
            $reserva = Reserva::create([
                'fecha' => $validated['fecha'],
                'hora' => $validated['hora'],
                'direccion' => $validated['direccion'] ?? null,
                'valor' => $total,
                'estado' => 'pendiente',
                'numero_doc' => $numeroDocumento,
                'nit' => $validated['nit'],
            ]);

            DetallePago::create([
                'fecha_pago' => now(),
                'precio_total' => $total,
                'precio_con_iva' => $total,
                'descuento' => 0,
                'estado_pago' => true,
                'id_cliente' => $usuario?->id,
                'id_reserva' => $reserva->id_reserva,
            ]);

            return $reserva;
        });

        $emailSent = null;
        if ($usuario?->email) {
            try {
                Mail::to($usuario->email)->send(new ReservaConfirmada(
                    $reserva,
                    $grupo,
                    $horas,
                    $total,
                    $validated['metodo_pago'] ?? 'card'
                ));
                $emailSent = $usuario->email;
            } catch (\Throwable $exception) {
                report($exception);
            }
        }

        return response()->json([
            'message' => 'Reserva creada correctamente.',
            'data' => $reserva,
            'email_sent' => $emailSent,
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

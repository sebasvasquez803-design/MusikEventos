<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de reserva</title>
</head>
<body style="margin:0;padding:32px 12px;background:#efebed;font-family:Arial,sans-serif;color:#171717;">
    <div style="max-width:620px;margin:auto;background:#fff;border:1px solid #ddd7ca;border-radius:16px;overflow:hidden;">
        <div style="padding:28px;background:#171717;border-bottom:3px solid #c9a24a;text-align:center;">
            <h1 style="margin:0;color:#e1c274;font-size:24px;">MusikEventos</h1>
            <p style="margin:8px 0 0;color:#fff;font-size:14px;">Confirmación de reserva</p>
        </div>
        <div style="padding:28px;">
            <p>Hola,</p>
            <p>Tu pago y reserva fueron registrados correctamente.</p>

            <table width="100%" cellpadding="10" cellspacing="0" style="margin-top:18px;border-collapse:collapse;">
                <tr style="background:#f7f4ec;">
                    <td style="border-bottom:1px solid #e7e1d5;"><strong>Grupo</strong></td>
                    <td align="right" style="border-bottom:1px solid #e7e1d5;">{{ $grupo?->nombre_grupo ?? 'Grupo Musical' }}</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #e7e1d5;"><strong>Fecha</strong></td>
                    <td align="right" style="border-bottom:1px solid #e7e1d5;">{{ $reserva->fecha }}</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #e7e1d5;"><strong>Hora</strong></td>
                    <td align="right" style="border-bottom:1px solid #e7e1d5;">{{ $reserva->hora }}</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #e7e1d5;"><strong>Dirección</strong></td>
                    <td align="right" style="border-bottom:1px solid #e7e1d5;">{{ $reserva->direccion }}</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #e7e1d5;"><strong>Duración</strong></td>
                    <td align="right" style="border-bottom:1px solid #e7e1d5;">{{ $horas }} {{ $horas === 1 ? 'hora' : 'horas' }}</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #e7e1d5;"><strong>Método</strong></td>
                    <td align="right" style="border-bottom:1px solid #e7e1d5;">
                        {{ $metodoPago === 'card' ? 'Tarjeta' : ($metodoPago === 'pse' ? 'PSE' : 'Billetera') }}
                    </td>
                </tr>
                <tr style="background:#171717;color:#fff;">
                    <td><strong>Total pagado</strong></td>
                    <td align="right"><strong>${{ number_format($total, 0, ',', '.') }} COP</strong></td>
                </tr>
            </table>

            <p style="margin-top:24px;color:#77746d;font-size:12px;">Número de reserva: #{{ $reserva->id_reserva }}</p>
        </div>
    </div>
</body>
</html>

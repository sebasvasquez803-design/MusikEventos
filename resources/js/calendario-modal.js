import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

let calendarModal = null;

export function iniciarCalendarioModal(nit) {
    const el = document.getElementById('calendar-modal');
    if (!el) return;

    if (calendarModal) {
        calendarModal.destroy();
    }

    calendarModal = new Calendar(el, {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        initialView: 'timeGridWeek',
        locale: 'es',
        selectable: true,
        selectMirror: true,
        nowIndicator: true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay',
        },
        slotMinTime: '08:00:00',
        slotMaxTime: '23:00:00',
        events: `/api/eventos-bloqueados/${nit}`,

        // Evitar seleccionar sobre bloqueados
        selectAllow: function (selectInfo) {
            const eventos = calendarModal.getEvents();
            for (let ev of eventos) {
                if (
                    selectInfo.start < ev.end &&
                    selectInfo.end > ev.start
                ) {
                    return false;
                }
            }
            return true;
        },

        select: function (info) {
            const fecha = info.startStr.split('T')[0];
            const hora  = info.startStr.split('T')[1]?.substring(0, 5) ?? '00:00';

            // Llenar campos del formulario de reserva
            document.getElementById('reserva-fecha').value = fecha;
            document.getElementById('reserva-hora').value  = hora;

            // Mostrar resumen al usuario
            document.getElementById('reserva-resumen').textContent =
                `Fecha: ${fecha}  |  Hora: ${hora}`;

            document.getElementById('form-reserva').style.display = 'block';
        },
    });

    calendarModal.render();
}

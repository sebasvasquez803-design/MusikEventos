import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';

document.addEventListener('DOMContentLoaded', function () {
    const el = document.getElementById('calendar-completo');
    if (!el) return;

    const calendar = new Calendar(el, {
        plugins: [dayGridPlugin, timeGridPlugin],
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay',
        },
        events: '/api/eventos-calendario',

        eventClick: function (info) {
            const props = info.event.extendedProps;
            alert(
                `Evento: ${info.event.title}\n` +
                `Estado: ${props.estado}\n` +
                `Dirección: ${props.direccion ?? 'No especificada'}`
            );
        },
    });

    calendar.render();
});

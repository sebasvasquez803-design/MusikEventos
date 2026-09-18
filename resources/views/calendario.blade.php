    <style>
        body { font-family: ui-sans-serif, system-ui, sans-serif; padding: 2rem; background-color: #f9fafb; }
        .container { max-width: 1000px; margin: 0 auto; background: #ffffff; padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
    </style>
@vite(['resources/css/calendario.css', 'resources/js/calendario.js'])
<div class="container">
    <!-- Elemento del DOM donde se pintará el calendario -->
    <div id="calendar-app">
        <h2 class="calendar-heading">Selecciona tu Fecha</h2>
        <div class="calendar-view"></div>
        <div class="calendar-selected-date" aria-live="polite">
            <span>Fecha seleccionada</span>
            <strong>Selecciona un día para tu evento</strong>
        </div>
    </div>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Buscamos el contenedor HTML
            const calendarEl = document.querySelector('#calendar-app .calendar-view');
            const selectedDate = document.querySelector('#calendar-app .calendar-selected-date strong');
            let selectedDayEl = null;

            // Instanciamos usando las variables globales expuestas en app.js
            const calendar = new window.Calendar(calendarEl, {
                plugins: [ window.dayGridPlugin, window.interactionPlugin ],
                initialView: 'dayGridMonth',
                locale: 'es', // Cambia los textos e idioma a español
                editable: false,
                selectable: true,
                
                // Consumir la ruta de Laravel directamente
                events: '/api/events',

                // Evento disparado al hacer clic en una fecha vacía
                dateClick: function(info) {
                    if (selectedDayEl) {
                        selectedDayEl.classList.remove('calendar-day-selected');
                    }

                    selectedDayEl = info.dayEl;
                    selectedDayEl.classList.add('calendar-day-selected');
                    selectedDate.textContent = info.date.toLocaleDateString('es-ES', {
                        weekday: 'long',
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });
                },

                // Evento disparado al hacer clic en un evento existente
                eventClick: function(info) {
                    alert('Has hecho clic en el evento: ' + info.event.title);
                }
            });

            // Renderizar el calendario en pantalla
            calendar.render();
        });
        </script>

@vite('resources/js/transicion.js')
<x-layouts::app.sidebar :title="__('Calendario de eventos')">

<div class="calendario-page">
    <h2>
        @if(auth()->user()->id_tipo_persona == 3)
            📅 Mis reservas
        @else
            📅 Eventos de mi grupo
        @endif
    </h2>

    <div id="calendar-completo" style="max-width:1100px; margin:0 auto;"></div>
</div>

<script>
    // El calendario-completo.js ya se importa desde app.js
</script>
</x-layouts::app.sidebar>

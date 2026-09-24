<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/admin.css')
    <title>Subgéneros</title>
</head>
<body>
    @include('components.admin-header')

    <main class="admin-panel">
        <section class="admin-card" style="max-width: 900px; margin: 0 auto;">
            <h2>Subgéneros</h2>

            <div class="admin-actions" style="margin-bottom: 18px;">
                <a href="{{ route('sub-generos.create') }}">Nuevo subgénero</a>
                <a href="{{ route('panel.admin') }}">Volver al panel</a>
            </div>

            <ul class="admin-list">
                @forelse ($subgeneros as $subgenero)
                    <li>
                        <span>{{ $subgenero->nombre_subgenero }}</span>
                        <div class="admin-item-actions">
                            <a href="{{ route('sub-generos.edit', $subgenero) }}">Editar</a>
                            <form method="POST" action="{{ route('sub-generos.destroy', $subgenero) }}" onsubmit="return confirm('¿Deseas eliminar este subgénero?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Eliminar</button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li>No hay subgéneros registrados.</li>
                @endforelse
            </ul>
        </section>
    </main>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/admin.css')
    <title>Géneros</title>
</head>
<body>
    @include('components.admin-header')

    <main class="admin-panel">
        <section class="admin-card" style="max-width: 900px; margin: 0 auto;">
            <h2>Géneros</h2>

            <div class="admin-actions" style="margin-bottom: 18px;">
                <a href="{{ route('generos.create') }}">Nuevo género</a>
                <a href="{{ route('panel.admin') }}">Volver al panel</a>
            </div>

            <ul class="admin-list">
                @forelse ($generos as $genero)
                    <li>
                        <span>{{ $genero->nombre_genero }}</span>
                        <div class="admin-item-actions">
                            <a href="{{ route('generos.edit', $genero) }}">Editar</a>
                            <form method="POST" action="{{ route('generos.destroy', $genero) }}" onsubmit="return confirm('¿Deseas eliminar este género?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Eliminar</button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li>No hay géneros registrados.</li>
                @endforelse
            </ul>
        </section>
    </main>
</body>
</html>

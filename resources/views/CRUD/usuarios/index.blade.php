<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/admin.css')
    <title>Usuarios</title>
</head>
<body>
    @include('components.admin-header')

    <main class="admin-panel">
        <section class="admin-card" style="max-width: 900px; margin: 0 auto;">
            <h2>Usuarios</h2>

            <div class="admin-actions" style="margin-bottom: 18px;">
                <a href="{{ route('usuarios.create') }}">Nuevo usuario</a>
                <a href="{{ route('panel.admin') }}">Volver al panel</a>
            </div>

            <ul class="admin-list">
                @forelse ($usuarios as $usuario)
                    <li>
                        <span>{{ $usuario->nombre ?? 'Usuario' }} {{ $usuario->apellido ?? '' }}</span>
                        <div class="admin-item-actions">
                            <a href="{{ route('usuarios.edit', $usuario) }}">Editar</a>
                            <form method="POST" action="{{ route('usuarios.destroy', $usuario) }}" onsubmit="return confirm('¿Deseas eliminar este usuario?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Eliminar</button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li>No hay usuarios registrados.</li>
                @endforelse
            </ul>
        </section>
    </main>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/admin.css')
    <title>Editar género</title>
</head>
<body>
    @include('components.admin-header')

    <main class="admin-panel">
        <section class="admin-card" style="max-width: 600px; margin: 0 auto;">
            <h2>Editar género</h2>

            <form method="POST" action="{{ route('generos.update', $genero) }}">
                @csrf
                @method('PUT')

                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <label>
                        <span>Nombre del género</span>
                        <input type="text" name="nombre_genero" value="{{ old('nombre_genero', $genero->nombre_genero) }}" required>
                    </label>
                </div>

                <div class="admin-actions" style="margin-top: 20px;">
                    <button type="submit">Guardar cambios</button>
                    <a href="{{ route('generos.index') }}">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>

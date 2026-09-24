<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/admin.css')
    <title>Crear usuario</title>
</head>
<body>
    @include('components.admin-header')

    <main class="admin-panel">
        <section class="admin-card" style="max-width: 650px; margin: 0 auto;">
            <h2>Crear usuario</h2>

            <form method="POST" action="{{ route('usuarios.store') }}">
                @csrf

                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <label>
                        <span>Tipo de persona</span>
                        <select name="id_tipo_persona" required>
                            <option value="">Selecciona</option>
                            <option value="1" {{ request('tipo_persona') == 1 ? 'selected' : '' }}>Representante legal</option>
                            <option value="2" {{ request('tipo_persona') == 2 ? 'selected' : '' }}>Artista solista</option>
                            <option value="3" {{ request('tipo_persona') == 3 ? 'selected' : '' }}>Cliente</option>
                        </select>
                    </label>

                    <label>
                        <span>Nombre</span>
                        <input type="text" name="nombre" value="{{ old('nombre') }}">
                    </label>

                    <label>
                        <span>Apellido</span>
                        <input type="text" name="apellido" value="{{ old('apellido') }}">
                    </label>

                    <label>
                        <span>Número de documento</span>
                        <input type="text" name="numero_doc" value="{{ old('numero_doc') }}">
                    </label>
                </div>

                <div class="admin-actions" style="margin-top: 20px;">
                    <button type="submit">Guardar</button>
                    <a href="{{ route('usuarios.index') }}">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>

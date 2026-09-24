<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/admin.css')
    <title>Crear subgénero</title>
</head>
<body>
    @include('components.admin-header')

    <main class="admin-panel">
        <section class="admin-card" style="max-width: 600px; margin: 0 auto;">
            <h2>Crear subgénero</h2>

            <form method="POST" action="{{ route('sub-generos.store') }}">
                @csrf

                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <label>
                        <span>Nombre del subgénero</span>
                        <input type="text" name="nombre_subgenero" value="{{ old('nombre_subgenero') }}" required>
                    </label>

                    <label>
                        <span>Género</span>
                        <select name="id_genero" required>
                            <option value="">Selecciona un género</option>
                            @foreach(\App\Models\Genero::all() as $genero)
                                <option value="{{ $genero->id_genero }}">{{ $genero->nombre_genero }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>

                <div class="admin-actions" style="margin-top: 20px;">
                    <button type="submit">Guardar</button>
                    <a href="{{ route('sub-generos.index') }}">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>

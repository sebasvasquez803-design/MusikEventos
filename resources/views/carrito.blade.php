<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/carrito.css')
    <title>MUSIKEVENTOS | Carrito</title>
</head>

<body>

    <!-- HEADER -->
 <header>
    <a href="{{ route('home') }}" class="button" aria-label="Volver al inicio">
      <div class="button-box">
        <span class="button-elem">
          <svg viewBox="0 0 46 40" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"
            ></path>
          </svg>
        </span>
        <span class="button-elem">
          <svg viewBox="0 0 46 40">
            <path
              d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"
            ></path>
          </svg>
        </span>
      </div>
    </a>

        <h1>RESERVA AQUÍ !!!</h1>
            <img class="logo" src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="logo">
    </header>



    <!-- CONTENIDO -->
    <main class="main-container">

        <h1 class="page-title">Carrito de Reservas</h1>

        <div class="content-wrapper">

            <!-- RESUMEN DEL GRUPO -->
            <section class="group-card">

                <div class="group-image">

                    <img src="assets/grupo.jpg"
                         alt="Grupo musical">

                </div>

                <div class="group-info">

                    <h2>Grupo Musical</h2>

                    <span class="group-category">
                        Grupo musical
                    </span>

                    <p>
                        Reserva este grupo musical para tu evento.
                        Selecciona la fecha, hora y duración de la presentación.
                    </p>

                    <div class="price-info">

                        <span>Precio por hora</span>

                        <strong>
                            $150.000
                        </strong>

                    </div>

                </div>

            </section>


            <!-- FORMULARIO RESERVA -->
            <section class="reservation-card">

                <div class="card-header">

                    <h2>Datos de la reserva</h2>

                    <span class="cart-icon">
                        🛒
                    </span>

                </div>


                <form class="reservation-form">

                    <!-- FECHA -->
                    <div class="form-group">

                        <label for="fecha">
                            Fecha del evento
                        </label>

                        <input
                            type="date"
                            id="fecha"
                            name="fecha"
                        >

                    </div>


                    <!-- HORA -->
                    <div class="form-group">

                        <label for="hora">
                            Hora del evento
                        </label>

                        <input
                            type="time"
                            id="hora"
                            name="hora"
                        >

                    </div>


                    <!-- DIRECCIÓN -->
                    <div class="form-group full">

                        <label for="direccion">
                            Dirección del evento
                        </label>

                        <input
                            type="text"
                            id="direccion"
                            name="direccion"
                            maxlength="60"
                            placeholder="Ingresa la dirección donde se realizará el evento"
                        >

                    </div>


                    <!-- HORAS -->
                    <div class="form-group">

                        <label for="horas">
                            Número de horas
                        </label>

                        <input
                            type="number"
                            id="horas"
                            name="horas"
                            min="1"
                            placeholder="Ej. 3"
                        >

                    </div>


                    <!-- PRECIO POR HORA -->
                    <div class="form-group">

                        <label for="precio_hora">
                            Precio por hora
                        </label>

                        <input
                            type="text"
                            id="precio_hora"
                            name="precio_hora"
                            value="$150.000"
                            readonly
                        >

                    </div>


                    <!-- VALOR TOTAL -->
                    <div class="total-container">

                        <span class="total-label">
                            Valor total de la reserva
                        </span>

                        <input
                            type="text"
                            id="valor"
                            name="valor"
                            class="total-price"
                            placeholder="$0"
                            readonly
                        >

                    </div>


                    <!-- BOTONES -->
                    <div class="form-buttons">

                        <a href="#" class="btn-cancel">
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            class="btn-reserve">
                            Confirmar reserva
                        </button>

                    </div>

                </form>

            </section>

        </div>

    </main>

</body>
</html>

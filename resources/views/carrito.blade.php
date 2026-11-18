<!DOCTYPE html>
<html lang="es">
<head>
    @include('partials.theme')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/carrito.css')
    @vite('resources/js/carrito.js')
    <title>MUSIKEVENTOS | Carrito</title>
</head>

<body class="cart-page">

    @if(isset($grupo) && $grupo)
        <script>window.__CART_GROUP = {!! json_encode($grupo) !!};</script>
    @else
        <script>window.__CART_GROUP = null;</script>
    @endif

    <!-- HEADER -->
<header class="cart-header">
    <a href="{{ route('home') }}" class="back-button" aria-label="Volver al inicio">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2Z"/></svg>
        <span>Volver</span>
    </a>

    <a href="{{ route('home') }}" class="brand-heading" aria-label="Ir a MusikEventos">
        <img class="logo" src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="">
        <div>
            <span>MusikEventos</span>
            <strong>Reserva tu presentación</strong>
        </div>
    </a>

    <div class="secure-reservation">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 1 3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4Zm-1 16-4-4 1.41-1.41L11 14.17l5.59-5.59L18 10l-7 7Z"/></svg>
        Reserva segura
    </div>
</header>



    <!-- CONTENIDO -->
    <main class="main-container">

        <nav class="reservation-breadcrumb" aria-label="Proceso de reserva">
            <span class="completed"><b>1</b> Selección</span>
            <i></i>
            <span class="active"><b>2</b> Datos del evento</span>
            <i></i>
            <span><b>3</b> Confirmación</span>
        </nav>

        <div class="page-heading">
            <div>
                <span class="page-eyebrow">Finaliza tu reserva</span>
                <h1 class="page-title">Diseña tu evento perfecto</h1>
            </div>
            <p>Completa los detalles y asegura la presentación de tu grupo.</p>
        </div>

        <div class="content-wrapper">

            <!-- RESUMEN DEL GRUPO -->
            <section class="group-card">

                <div class="group-image">

                    <img id="cart-group-image" src="{{ isset($grupo) && $grupo->logo_url ? $grupo->logo_url : asset('storage/img/grupos/logoMusikEventos.png') }}"
                        alt="Grupo musical">
                    <span class="availability-badge"><span></span> Disponible</span>

                </div>

                <div class="group-info">

                    <span class="selection-label">Grupo seleccionado</span>
                    <h2 id="cart-group-name">{{ $grupo->nombre_grupo ?? 'Grupo Musical' }}</h2>

                    <span class="group-category" id="cart-group-category">
                        Presentación en vivo
                    </span>

                    <p>
                        Personaliza la fecha y la duración de la presentación para tu evento.
                    </p>

                    <div class="price-info">

                        <span>Precio por hora</span>

                        <strong id="cart-price-value">
                            {{ isset($grupo) && $grupo->precio_hora ? ('$' . number_format($grupo->precio_hora, 0, ',', '.')) : '$0' }}
                        </strong>

                    </div>

                </div>

            </section>


            <!-- FORMULARIO RESERVA -->
            <section class="reservation-card">

                <div class="card-header">

                    <div>
                        <span class="card-kicker">Paso 2 de 3</span>
                        <h2>Datos de la reserva</h2>
                        <p>Ingresa la información principal del evento.</p>
                    </div>

                    <span class="cart-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24"><path d="M7 18a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm10 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM7.16 14h9.72a2 2 0 0 0 1.94-1.51l1.12-4.5A1.5 1.5 0 0 0 18.47 6H6.21l-.3-1.5A1 1 0 0 0 4.92 3.6H3a1 1 0 1 0 0 2h1.18l1.78 8.3-.8 1.45A2 2 0 0 0 6.9 18H19a1 1 0 1 0 0-2H7l.16-.28L7.16 14ZM6.5 8h11.05l-.88 3.5H7.2L6.5 8Z"/></svg>
                    </span>

                </div>


                <form class="reservation-form" id="reservation-form">
                    @csrf
                    <input type="hidden" name="nit" value="{{ $grupo->nit ?? '' }}">

                    <!-- FECHA -->
                    <div class="form-group">

                        <label for="fecha">
                            Fecha del evento
                        </label>

                        <input
                            type="date"
                            id="fecha"
                            name="fecha"
                            required
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
                            required
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
                            required
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
                            max="12"
                            placeholder="Ej. 3"
                            required
                        >

                    </div>

                    <div class="duration-options full" aria-label="Duraciones sugeridas">
                        <button type="button" data-hours="2">2 horas</button>
                        <button type="button" data-hours="3">3 horas</button>
                        <button type="button" data-hours="4">4 horas</button>
                        <button type="button" data-hours="5">5 horas</button>
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
                        <div class="total-copy">
                            <span class="total-label">Valor total de la reserva</span>
                            <small>Sin cargos adicionales</small>
                        </div>

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

                        <a href="{{ route('home') }}" class="btn-cancel">
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

    <div class="checkout-overlay" id="checkout-overlay" aria-hidden="true">
        <section class="checkout-modal" role="dialog" aria-modal="true" aria-labelledby="checkout-title">
            <button type="button" class="checkout-close" id="checkout-close" aria-label="Cerrar pago">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18.3 5.71 16.89 4.3 12 9.17 7.11 4.29 5.7 5.7 10.59 10.59 5.7 15.47l1.41 1.42 4.89-4.88 4.89 4.88 1.41-1.42-4.88-4.88z"/></svg>
            </button>

            <div class="checkout-content">
                <div class="checkout-main">
                    <div class="checkout-heading">
                        <span>Paso 3 de 3</span>
                        <h2 id="checkout-title">Finalizar pago</h2>
                        <p>Elige cómo deseas pagar tu reserva.</p>
                    </div>

                    <div class="payment-methods" role="radiogroup" aria-label="Método de pago">
                        <button type="button" class="payment-method is-selected" data-method="card" role="radio" aria-checked="true">
                            <span class="payment-icon">VISA</span>
                            <span><strong>Tarjeta</strong><small>Débito o crédito</small></span>
                            <b></b>
                        </button>
                        <button type="button" class="payment-method" data-method="pse" role="radio" aria-checked="false">
                            <span class="payment-icon pse-icon">PSE</span>
                            <span><strong>PSE</strong><small>Débito bancario</small></span>
                            <b></b>
                        </button>
                        <button type="button" class="payment-method" data-method="wallet" role="radio" aria-checked="false">
                            <span class="payment-icon wallet-icon">
                                <svg viewBox="0 0 24 24"><path d="M18 6H6a3 3 0 0 0-3 3v6a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3V9a3 3 0 0 0-3-3Zm-1 9h-5v-2h5v2Zm3-5H4v-1a1 1 0 0 1 1-1h12a3 3 0 0 1 3 2Z"/></svg>
                            </span>
                            <span><strong>Billetera</strong><small>Nequi o Daviplata</small></span>
                            <b></b>
                        </button>
                    </div>

                    <form class="payment-form" id="payment-form" novalidate>
                        <div class="payment-fields" data-fields="card">
                            <div class="form-field full">
                                <label for="card-name">Nombre en la tarjeta</label>
                                <input id="card-name" name="card-name" type="text" autocomplete="cc-name" placeholder="Como aparece en la tarjeta">
                            </div>
                            <div class="form-field full">
                                <label for="card-number">Número de tarjeta</label>
                                <div class="input-with-icon">
                                    <input id="card-number" name="card-number" type="text" inputmode="numeric" autocomplete="cc-number" maxlength="19" placeholder="0000 0000 0000 0000">
                                    <span>VISA</span>
                                </div>
                            </div>
                            <div class="form-field">
                                <label for="card-expiry">Caducidad</label>
                                <input id="card-expiry" name="card-expiry" type="text" inputmode="numeric" autocomplete="cc-exp" maxlength="5" placeholder="MM/AA">
                            </div>
                            <div class="form-field">
                                <label for="card-cvv">Código de seguridad</label>
                                <input id="card-cvv" name="card-cvv" type="password" inputmode="numeric" autocomplete="cc-csc" maxlength="4" placeholder="CVV">
                            </div>
                        </div>

                        <div class="payment-fields is-hidden" data-fields="pse">
                            <div class="form-field full">
                                <label for="pse-bank">Banco</label>
                                <select id="pse-bank" name="pse-bank">
                                    <option value="">Selecciona tu banco</option>
                                    <option>Bancolombia</option>
                                    <option>Banco de Bogotá</option>
                                    <option>Davivienda</option>
                                    <option>BBVA</option>
                                    <option>Scotiabank Colpatria</option>
                                </select>
                            </div>
                            <div class="form-field full">
                                <label for="pse-person">Tipo de persona</label>
                                <select id="pse-person" name="pse-person">
                                    <option>Persona natural</option>
                                    <option>Persona jurídica</option>
                                </select>
                            </div>
                        </div>

                        <div class="payment-fields is-hidden" data-fields="wallet">
                            <div class="form-field full">
                                <label for="wallet-type">Billetera</label>
                                <select id="wallet-type" name="wallet-type">
                                    <option value="">Selecciona una billetera</option>
                                    <option>Nequi</option>
                                    <option>Daviplata</option>
                                </select>
                            </div>
                            <div class="form-field full">
                                <label for="wallet-phone">Número de celular</label>
                                <input id="wallet-phone" name="wallet-phone" type="tel" inputmode="tel" maxlength="10" placeholder="300 000 0000">
                            </div>
                        </div>

                        <label class="terms-check">
                            <input type="checkbox" id="payment-terms">
                            <span>Acepto los términos de la reserva y la política de cancelación.</span>
                        </label>

                        <button type="submit" class="pay-button" id="pay-button">
                            <span>Pagar ahora</span>
                            <strong id="pay-button-total">$0</strong>
                        </button>
                        <p class="payment-error" id="payment-error" role="alert"></p>
                    </form>
                </div>

                <aside class="checkout-summary">
                    <span class="summary-label">Resumen del pedido</span>
                    <div class="summary-group">
                        <img id="checkout-group-image" src="{{ isset($grupo) && $grupo->logo_url ? $grupo->logo_url : asset('storage/img/grupos/logoMusikEventos.png') }}" alt="">
                        <div>
                            <strong id="checkout-group-name">{{ $grupo->nombre_grupo ?? 'Grupo Musical' }}</strong>
                            <span>Presentación en vivo</span>
                        </div>
                    </div>
                    <dl class="summary-details">
                        <div><dt>Fecha</dt><dd id="summary-date">Por definir</dd></div>
                        <div><dt>Hora</dt><dd id="summary-time">Por definir</dd></div>
                        <div><dt>Dirección</dt><dd id="summary-address">Por definir</dd></div>
                        <div><dt>Duración</dt><dd id="summary-hours">1 hora</dd></div>
                    </dl>
                    <div class="summary-totals">
                        <div><span>Subtotal</span><strong id="summary-subtotal">$0</strong></div>
                        <div><span>Servicio</span><strong>Incluido</strong></div>
                        <div class="summary-total"><span>Total</span><strong id="summary-total">$0</strong></div>
                    </div>
                    <div class="secure-note">
                        <svg viewBox="0 0 24 24"><path d="M12 1 3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4Zm0 11.99h7c-.53 4.12-2.97 7.11-7 8.93V13H5V6.3l7-3.11V13Z"/></svg>
                        Información protegida y cifrada
                    </div>
                </aside>
            </div>

            <div class="checkout-success" id="checkout-success" aria-live="polite">
                <span class="success-mark">
                    <svg viewBox="0 0 24 24"><path d="m9.2 16.6-4.3-4.3 1.8-1.8 2.5 2.5 8.1-8.1 1.8 1.8z"/></svg>
                </span>
                <span class="page-eyebrow">Pago realizado</span>
                <h2>Tu reserva fue confirmada</h2>
                <p id="checkout-success-message">Recibirás los detalles de tu presentación en tu cuenta.</p>
                <p class="confirmation-email" id="confirmation-email"></p>
                <a href="{{ route('home') }}" class="success-button">Volver al inicio</a>
            </div>
        </section>
    </div>

</body>
</html>

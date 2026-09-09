<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/mas_info.css')
    <title>MusikEventos</title>
    <link rel="shortcut icon" href="{{ asset('storage/img/musike.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<!-- ENCABEZADO -->
<header>


    <!-- Menu de navegacion principal -->
    <div class="menu">
        <ul>
            <li><a href="{{ route('grupo.musical') }}">UNETE COMO GRUPO MUSICAL</a></li>
            <li><a href="#">CALENDARIO</a></li>
            <li><a href="{{ route('reserva') }}">RESERVA AQUI</a></li>
            <div class="carro">
                <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
            <div class="usuario">
                <a href="{{ route('registro.clientes') }}"><i class="fa-solid fa-circle-user"></i></a>
            </div>
        </ul>
    </div>

    <!-- Logo -->
    <a href="{{ route('home') }}">
        <img class="logo" src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="logo">
    </a>

</header>

<div class="cards_c">
  <article class="card">
   
    <div class="content">
      <p>
       
      </p>
    </div>
  </article>


<div class="cards_p">
  <article class="card2">
   
    
  </article>

  </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/dashboard.css')
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <!--Encabezado del sitio-->



 <div class="contenido">
    
    <div class="dashboard">      
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
    <h2>Registro De Grupos</h2>
    
    <p class="subtitulo-dashboard">
        Bienvenido al sistema de registro de grupos de MusikEventos.
    </p>
    <div class="dashboard-cards">
        <a href="{{ route('sesion.rep.leg') }}" class="dashboard-card">
            <i class="fa-solid fa-user-tie"></i>
            <h3>Registrar Representante</h3>
            <p>Registrar representantes en la plataforma.</p>
        </a>

        <a href="{{ route('grupo.musical') }}" class="dashboard-card">
            <i class="fa-solid fa-users"></i>
            <h3>Registrar Grupo Musical</h3>
            <p>Registrar grupos musicales con representante legal.</p>
        </a>

        <a href="{{ route('sesion.rep.leg') }}" class="dashboard-card">
            <i class="fa-solid fa-user-tie"></i>
            <h3>Registrar Artista</h3>
            <p>Registrar artistas en la plataforma.</p>
        </a>

        <a href="{{ route('grupo.musical') }}" class="dashboard-card">
            <i class="fa-solid fa-users"></i>
            <h3>Unirse a un Grupo</h3>
            <p>Unirse a un grupo musical existente.</p>
        </a>
    </div> 

    
</div>
</div>
</body>
</html>
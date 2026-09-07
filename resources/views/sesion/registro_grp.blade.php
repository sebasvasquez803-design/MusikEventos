<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     @vite('resources/css/estilo_reg_grupo.css')
    <title>Registro de Grupo</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
         integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity=
        "sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
         crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!--funcion de js para mensaje por pantalla-->

</head>
<body>
  <!--Encabezado del sitio-->
    <header>
        <a href="../index1.php">  <img class="logo" src="{{ asset('storage/img/grupos/logoMusikEventos.png') }}" alt="logo"></a>
          <h1>REGISTRO DE GRUPOS MUSICALES</h1>
    </header>

  <div class="conte">
            <aside class="contenedor">
                 <img class="img-contenedor" src="{{asset('storage/img/inside.jpeg') }}" alt="barra lateral">
            </aside>


<!--formulario-->
<form class="form-basico" name="formulario" action="{{ route('grupo-musical.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<!--campos del formulario-->

        <div class="entrada">
            <label>NIT</label>
            <input type="text" placeholder="Ejemplo: 123456789" name="nit" class="campo" required >
               <span class="icon"><i class="fa-solid fa-circle-check"></i></span>

            </div>


        <div class="entrada">
            <label>Nombre Del Grupo</label>
            <input type="text" placeholder="Nombre del grupo" name="nombre_grupo" class="campo" required>
            <span class="icon"><i class="fa-solid fa-circle-check"></i></span>

        </div>

            <div class="entrada">
            <label>Telefono</label>
            <input type="number" placeholder="Número de teléfono" name="telefono" class="campo" required>
            <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
        </div>

            <div class="entrada">
            <label>Email</label>
            <input type="email" placeholder="Ejemplo@email.com" name="email" class="campo" required>
            <span class="icon"><i class="fa-solid fa-circle-check"></i></span>
        </div>

        <div class="entrada">

            <label for="inputImagen">Imagen del grupo</label>
            <input type="file" id="inputImagen" name="avatar" accept="image/jpeg,image/png,image/jpg,image/webp">

        </div>

         <div class="entrada">
            <label>Descripcion</label>
            <textarea name="descripcion"></textarea>
        </div>

        <!--boton del formulario-->
         <div class="boton">
            <input type="submit" value="Registrar" name="botingresar">
        </div>


    </form><!--cierre del formulario-->



</body>
</html>

function validar(){

    let usuario = document.querySelector('input[type="email"]').value;
    let contraseña = document.querySelector('input[type="password"]').value;    

    if(usuario == "" || contraseña == ""){

        swal({
            title:"Campos Vacíos",
            text:"Por favor complete todos los campos.",
            icon:"warning",
            button:"Aceptar"
        });

    }else{

        swal({
            title:"Datos Confirmados",
            text:"Inicio de sesión exitoso.",
            icon:"success",
            button:"Aceptar"
        });

    }

}
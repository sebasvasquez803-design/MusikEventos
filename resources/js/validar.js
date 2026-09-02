function validar() {

    //validacion del NIT
    var nit = document.formulario.NIT;
    if (nit.value.trim() != "") {
        swal("success", "Has ingresado el NIT: " + nit.value);
    } else {
        swal("Oops!", "No has ingresado el NIT. \n \n Debes ingresar el NIT del grupo para poder enviar el formulario", 'error');
        return false;
    }

    //validacion del Nombre del grupo
    var nombre = document.formulario.NOMBRE;
    if (nombre.value.trim() != "") {
        swal("success", "Has ingresado el nombre: " + nombre.value);
    } else {
        swal("Oops!", "No has ingresado el nombre del grupo. \n \n Debes ingresar el nombre para poder enviar el formulario", 'error');
        return false;
    }

    //validacion del Telefono
    var telefono = document.formulario.phone;
    if (telefono.value.trim() != "") {
        swal("success", "Has ingresado el teléfono: " + telefono.value);
    } else {
        swal("Oops!", "No has ingresado el teléfono. \n \n Debes ingresar un número de teléfono para poder enviar el formulario", 'error');
        return false;
    }

    //validacion del Email
    var email = document.formulario.email;
    if (email.value.trim() != "") {
        swal("Confirmación", "Has ingresado el correo: " + email.value + "\n \n El formulario ha sido registrado exitosamente.", 'success');
    } else {
        swal("Oops!", "El formulario no ha podido enviarse. \n \n Debe ingresar un correo electrónico para poder enviar el formulario", 'error');
        return false;
    }

    return false;

    window.location.href = "../formularios/registro_grp.html";
}
//Función para validar las publicaciones
function validarPublicacion(){
    let esValido = true;
    let titulo = document.getElementById("titulo_publicacion");
    let descripcion = document.querySelector(".publicacionDescripcion");
    let nombre = document.getElementById("nombre");
    let telefono = document.getElementById("telefono");
    let tipoPublicacion = document.getElementById("tipo_publicacion");
    let fechaPublicacion = document.getElementById("fecha_publicacion");
    let fechaActual = new Date();
    let nombreRegex = /^[a-zA-Z\s]+$/;
    let telefonoRegex = /^[0-9]+$/;

    if(titulo.value === ""){
        alert("El título no puede estar vacío");
        esValido = false;
    }else if(titulo.value.length < 10){
        alert("El título debe tener mínimo 10 caracteres");
        esValido = false;
    }

    if(tipoPublicacion === ""){
        alert("Seleccione el tipo de publicacion");
        esValido = false;
    }

    if(descripcion.value === ""){
        alert("La descripción no puede estar vacía");
        esValido = false;
    }else if(descripcion.value.length < 15){
        alert("La descripcion debe tener mínimo 15 caracteres");
        esValido = false;
    }

    if(nombre.value === ""){
        alert("El nombre no puede estar vacío");
        esValido = false;
    }else if(nombre.value.length < 5){
        alert("El nombre debe tener minimo 5 caracteres");
        esValido = false;
    }else if(!nombreRegex.test(nombre.value)){
        alert("El nombre solo puede tener letras");
        esValido = false;
    }
        
    if(telefono.value === ""){
        alert("El teléfono no puede estar vacío");
        esValido = false;
    }else if(telefono.value.length !== 10){
        alert("El teléfono debe tener 10 digitos");
        esValido = false;
    }else if(!telefonoRegex.test(telefono.value)){
        alert("El teléfono solo puede tener números");
        esValido = false;
    }

    if(fechaPublicacion === ""){
        alert("La fecha es requerida");
        esValido = false;
    }else{
        let fechaSeleccionada = new Date(fechaPublicacion.value);
        if(fechaSeleccionada > fechaActual){
            alert("La fecha selecionada no puede ser mayor a la fecha actual");
            esValido = false;
        }else if(fechaSeleccionada < fechaActual){
            alert("La fecha seleccionada no puede ser menor a la fecha actual");
            esValido = false;
        }
    }
    return esValido;
}
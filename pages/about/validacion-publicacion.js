//Función para validar las publicaciones
function validarPublicacion(){
    let esValido = true;
    let validarCaracteres = /^[a-zA-Z\s]+$/;

    //Valida título de la publicación
    let titulo = document.getElementById("titulo_publicacion");

    if(titulo.value === ""){
        alert("El título no puede estar vacío");
        esValido = false;
    }else if(titulo.value.length < 10){
        alert("El título debe tener mínimo 10 caracteres");
        esValido = false;
    }else if(!validarCaracteres.test(titulo.value)){
        alert("El título solo puede tener letras");
        esValido = false;
    }

    //Valida tipo de publicación
    let tipoPublicacion = document.getElementById("tipo_publicacion");

    if(tipoPublicacion === ""){
        alert("Seleccione el tipo de publicacion");
        esValido = false;
    }

    //Valida descripción de la publicación
    let descripcion = document.querySelector(".publicacionDescripcion");

    if(descripcion.value === ""){
        alert("La descripción no puede estar vacía");
        esValido = false;
    }else if(descripcion.value.length < 15){
        alert("La descripcion debe tener mínimo 15 caracteres");
        esValido = false;
    }

    //Valida prioridad del evento
    let prioridad = document.querySelector('input[name="prioridad"]:checked');
    if(!prioridad){
        alert("Debe seleccionar una prioridad para su publicación");
        esValido = false;
    }

    //Valida fecha del evento
    let fechaPublicacion = document.getElementById("fecha_publicacion");
    let fechaActual = new Date();
    
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

    //Valida nombre del publicante
    let nombre = document.getElementById("nombre");
    
    if(nombre.value === ""){
        alert("El nombre no puede estar vacío");
        esValido = false;
    }else if(nombre.value.length < 5){
        alert("El nombre debe tener minimo 5 caracteres");
        esValido = false;
    }else if(!validarCaracteres.test(nombre.value)){
        alert("El nombre solo puede tener letras");
        esValido = false;
    }

    //Valida teléfono del publicante
    let telefono = document.getElementById("telefono");
    let telefonoRegex = /^[0-9]+$/;

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

    //Valida el correo electrónico del publicante
    let correo = document.querySelector('.campoCorreo input');

    if(correo.value === ""){
        alert("El correo electrónico es requerido");
        esValido = false;
    }

    //Valida checkbox notificar de la publicación
    let notificarSoloAdmin = document.querySelector('input[name="notificarSoloAdmins"]:checked');
    if(notificarSoloAdmin){
        alert("Ha seleccionado solo enviar a los administradores");
        esValido = false;
    }
    return esValido;
}
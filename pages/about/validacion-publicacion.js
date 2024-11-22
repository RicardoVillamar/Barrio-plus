//Función para validar las publicaciones
function validarPublicacion(){
    eliminarMensajes();
    let esValido = true;
    let validarCaracteres = /^[a-zA-Z\s]+$/;

    //Valida título de la publicación
    let titulo = document.getElementById("titulo_publicacion");
    if(titulo.value === ""){
        cargarMensaje("*El título no puede estar vacío", titulo);
        esValido = false;
    }else if(titulo.value.length < 10){
        cargarMensaje("*El título debe tener mínimo 10 caracteres", titulo);
        esValido = false;
    }else if(!validarCaracteres.test(titulo.value)){
        cargarMensaje("*El título solo puede tener letras", titulo);
        esValido = false;
    }

    //Valida tipo de publicación
    let tipoPublicacion = document.getElementById("tipo_publicacion");
    if(tipoPublicacion.value === ""){
        cargarMensaje("*Seleccione una publicación", tipoPublicacion);
        esValido = false;
    }

    //Valida descripción de la publicación
    let descripcion = document.querySelector(".publicacionDescripcion");
    if(descripcion.value === ""){
        cargarMensaje("*La descripción no puede estar vacía", descripcion);
        esValido = false;
    }else if(descripcion.value.length < 15){
        cargarMensaje("*La descripcion debe tener mínimo 15 caracteres", descripcion);
        esValido = false;
    }

    //Valida prioridad del evento
    let prioridad = document.querySelector('input[name="prioridad"]:checked');
    if(!prioridad){
        alert("!Debe seleccionar una prioridad para su publicación!");
        esValido = false;
    }

    //Valida fecha del evento
    let fechaPublicacion = document.getElementById("fecha_publicacion");
    let fechaActual = new Date();
    if(fechaPublicacion.value === ""){
        cargarMensaje("*La fecha es requerida", fechaPublicacion);
        esValido = false;
    }else{
        let fechaSeleccionada = new Date(fechaPublicacion.value);
        if(fechaSeleccionada<fechaActual){
            cargarMensaje("*La fecha no es válida", fechaPublicacion);
            esValido = false;
        }
    }

    //Valida nombre del publicante
    let nombre = document.getElementById("nombre");
    if(nombre.value === ""){
        cargarMensaje("*El nombre no puede estar vacío", nombre);
        esValido = false;
    }else if(nombre.value.length < 5){
        cargarMensaje("*El nombre debe tener minimo 5 caracteres", nombre);
        esValido = false;
    }else if(!validarCaracteres.test(nombre.value)){
        cargarMensaje("*El nombre solo puede tener letras", nombre);
        esValido = false;
    }

    //Valida teléfono del publicante
    let telefono = document.getElementById("telefono");
    let telefonoRegex = /^[0-9]+$/;
    if(telefono.value === ""){
        cargarMensaje("*El teléfono no puede estar vacío", telefono);
        esValido = false;
    }else if(telefono.value.length !== 10){
        cargarMensaje("*El teléfono debe tener 10 digitos", telefono);
        esValido = false;
    }else if(!telefonoRegex.test(telefono.value)){
        cargarMensaje("*El teléfono solo puede tener números", telefono);
        esValido = false;
    }

    //Valida el correo electrónico del publicante
    let correo = document.querySelector('.campoCorreo input');
    let correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(correo.value === ""){
        cargarMensaje("*El correo electrónico es requerido", correo);
        esValido = false;
    }else if(!correoRegex.test(correo.value)){
        cargarMensaje("*El correo electrónico no es válido", correo);
        esValido = false;
    }

    let notificarAdmin = document.querySelector('input[name="notificarSoloAdmins"]:checked');
    if(!notificarAdmin){
        alert("!La publicación se notificará a toda la comunidad!");
    }else{
        alert("!Ha seleccionado notificar solo a los administradores!");
    }
    return esValido;
}

function cargarMensaje(mensajeError, elemento){
    elemento.focus();
    let span = document.createElement("span");
    span.textContent = mensajeError;
    span.classList.add("error");
    elemento.parentNode.appendChild(span);
}

function eliminarMensajes(){
    let arrSpan = document.querySelectorAll(".error")
    arrSpan.forEach((span)=>{
            span.remove();
        }
    );
}
function validarFormulario() {
    let correcto = true;
  
    let nombre = document.getElementById("nombre");
    let nombreRegex = /^[a-zA-Z\s]*$/;
    
        if (nombre.value === "") {
            alert("Es obligatorio ingresar el Nombre");
            correcto = false;
        } else if (nombre.value.length > 100) {
              alert("El nombre es demasiado largo.");
              correcto = false;
        }else if (/ {2,}/.test(nombre.value)) {
              alert("El nombre no debe contener espacios consecutivos.");
              correcto = false;
        } else if (nombre.value.length < 2) {
          alert("El Nombre es muy corto");
          correcto = false;
        }  else if (!nombreRegex.test(nombre.value)) {
            alert("El Nombre no es correcto");
            correcto = false;
        } 
  
    let apellido = document.getElementById("apellido");
    let apellidoRegex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*$/;
    if (apellido.value === "") {
      alert("Es obligatorio ingresar el Apellido");
      correcto = false;
    }else if (apellido.value.length > 200) {
        alert("El apellido es demasiado largo.");
        correcto = false;
    }else if (/ {2,}/.test(apellido.value)) {
        alert("El apellido no debe contener espacios consecutivos.");
        correcto = false;
    } else if (!apellidoRegex.test(apellido.value)) {
        alert("El apellido no es correcto");
        correcto = false;
    } else if (apellido.value.length < 2) {
      alert("El Apellido es muy corto");
      correcto = false;
    }
  
    let correo = document.getElementById("correo");
    let correoRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  
    if (correo.value === "") {
      alert("Es obligatorio ingresar tu correo electronico");
      correcto = false;
    } else if (!correoRegex.test(correo.value)) {
      alert("El formato del correo electrónico es incorrecto");
      correcto = false;
    } else if (correo.value.length > 200) {
      alert("El correo electrónico es demasiado largo");
      correcto = false;
    }
   //==================================================================================
    let cant = document.getElementById("cant");
  
    if (cant.value === "") {
     alert("Cantidad de herramientas o mesas es obligatoria");
     correcto = false;
    }else if (cant(cantidad.value) || cantidad.value <= 0) {
     alert("La cantidad debe ser mayor a 0");
     correcto = false;
    }
  
   let fechaInicio;
   let fechainicio = document.getElementById("fecha-inicio").value;
   if (!fechainicio) {
     alert("La fecha de inicio de la reserva es obligatoria");
     correcto = false;
   } else {
     fechaInicio = new Date(fechainicio.value);
     let fechaActual = new Date();
     if (fechaInicio < fechaActual) {
       alert("La fecha de inicio de la reserva no puede ser anterior a la fecha actual.");
       correcto = false;
       return fechaInicio;
     }
   }
  
   let fechafinal = document.getElementById("fecha-final").value;
   if (!fechafinal) {
     alert("La fecha final de la reserva es obligatoria");
     correcto = false;
   } else {
     let fechaFinal = new Date(fechafinal.value);
     if (fechaFinal <= fechaInicio) {
       alert("La fecha final de la reserva no puede ser menor o igual a la de inicio de la reserva");
       correcto = false;
     }
   }
   let uso = document.getElementById("uso");
   if (uso.value === "") {
     alert("El propósito del uso de la herramienta o mesa es obligatorio");
     correcto = false ;
   }
  
   let capacita = document.querySelectorAll('input[name="capacita"]:checked');
    if (capacita.value === "") {
      correcto = true;
    }
    if(correcto){
      return correcto;
    }
  
  }
  

const formulario = document.getElementById("formulario-instalaciones");

// Personal
const nombre = document.getElementById("nombre");
const telefono = document.getElementById("telefono");

// Fecha
const fechadesde = document.getElementById("fecha-desde");
const fechahasta = document.getElementById("fecha-hasta");

// Informacion
const personasCantidad = document.getElementById("personas");
const proposito = document.querySelector(".propositos");
const notas = document.getElementById("notas");

// Caracteres permitidos
const nombreRegex = /^[a-zA-Z\s]*$/;
const telefonoRegex = /^[0-9]*$/;

// Errores
const nombreError = document.getElementById("nombre-error");
const telefonoError = document.getElementById("telefono-error");
const miembroError = document.getElementById("miembro-error");
const fechadesdeError = document.getElementById("fechaD-error");
const fechahastaError = document.getElementById("fechaH-error");
const personasError = document.getElementById("personas-error");
const propositoError = document.getElementById("proposito-error");

// ----------> Validar nombre
function validarNombre() {
  nombreError.textContent = "";
  if (nombre.value === "") {
    nombreError.textContent = "Nombre obligatorio";
    return false;
  } else if (nombre.value.length < 3) {
    nombreError.textContent = "Nombre muy corto";
    return false;
  } else if (!nombreRegex.test(nombre.value)) {
    nombreError.textContent = "Nombre incorrecto";
    return false;
  }
  return true;
}

nombre.addEventListener("blur", () => {
  if (!validarNombre()) {
    nombre.classList.add("input-error");
  } else {
    nombre.classList.remove("input-error");
  }
});

// ----------> Validar telefono
function validarTelefono() {
  telefonoError.textContent = "";
  if (telefono.value === "") {
    telefonoError.textContent = "Telefono obligatorio";
    return false;
  } else if (!telefonoRegex.test(telefono.value)) {
    telefonoError.textContent = "Telefono incorrecto";
    return false;
  } else if (telefono.value.length < 10) {
    telefonoError.textContent = "Telefono muy corto";
    return false;
  }
  return true;
}

telefono.addEventListener("blur", () => {
  if (!validarTelefono()) {
    telefono.classList.add("input-error");
  } else {
    telefono.classList.remove("input-error");
  }
});

const miembro = document.querySelector('input[name="miembro"]:checked');

// ----------> Validar miembro

function validarMiembro() {
  const miembroSeleccionado = document.querySelector(
    'input[name="miembro"]:checked'
  );
  miembroError.textContent = "";
  if (!miembroSeleccionado) {
    miembroError.textContent = "Seleccione una opción";
    return false;
  }
  return true;
}

const radiosMiembro = document.querySelectorAll('input[name="miembro"]');
radiosMiembro.forEach((radio) => {
  radio.addEventListener("change", () => {
    if (!validarMiembro()) {
      radiosMiembro.forEach((r) => r.classList.add("input-error"));
    } else {
      radiosMiembro.forEach((r) => r.classList.remove("input-error"));
    }
  });
});

// ----------> Validar fecha desde
function validarFechaDesde() {
  fechadesdeError.textContent = "";
  if (fechadesde.value === "") {
    fechadesdeError.textContent = "Fecha obligatoria";
    return false;
  } else {
    const fechaDesde = new Date(fechadesde.value);
    const fechaActual = new Date();
    if (fechaDesde <= fechaActual) {
      fechadesdeError.textContent =
        "Fecha no puede ser menor o igual a la actual";
      return false;
    }
  }
  return true;
}

fechadesde.addEventListener("blur", () => {
  if (!validarFechaDesde()) {
    fechadesde.classList.add("input-error");
  } else {
    fechadesde.classList.remove("input-error");
  }
});

// ----------> Validar fecha hasta

function validarFechaHasta() {
  fechahastaError.textContent = "";
  if (fechahasta.value === "") {
    fechahastaError.textContent = "Fecha obligatoria";
    return false;
  } else {
    const fechaHasta = new Date(fechahasta.value);
    if (fechadesde.value === "") {
      fechahastaError.textContent =
        "Debe seleccionar una fecha de inicio primero";
      return false;
    }
    const fechaDesde = new Date(fechadesde.value);
    if (fechaHasta < fechaDesde) {
      fechahastaError.textContent = "Fecha no puede ser menor a la de inicio";
      return false;
    }
  }
  return true;
}

fechahasta.addEventListener("blur", () => {
  if (!validarFechaHasta()) {
    fechahasta.classList.add("input-error");
  } else {
    fechahasta.classList.remove("input-error");
  }
});

// ----------> Validar personas
function validarPersonas() {
  personasError.textContent = "";
  if (personasCantidad.value === "") {
    personasError.textContent = "Cantidad de personas obligatoria";
    return false;
  }
  return true;
}

personasCantidad.addEventListener("blur", () => {
  if (!validarPersonas()) {
    personasCantidad.classList.add("input-error");
  } else {
    personasCantidad.classList.remove("input-error");
  }
});

// ----------> Validar proposito
function validarProposito() {
  propositoError.textContent = "";
  if (proposito.value === "") {
    propositoError.textContent = "Proposito obligatorio";
    return false;
  }
  return true;
}

proposito.addEventListener("blur", () => {
  if (!validarProposito()) {
    proposito.classList.add("input-error");
  } else {
    proposito.classList.remove("input-error");
  }
});

// ----------> Validar notas
function validarNotas() {
  notas.textContent = "";
  if (notas.value === "") {
    return true;
  }
}

notas.addEventListener("blur", () => {});

// Validar formulario
function validarFormulario() {
  let correcto = true;

  if (!validarNombre()) {
    correcto = false;
  }
  if (!validarTelefono()) {
    correcto = false;
  }

  if (!validarMiembro()) {
    correcto = false;
  }

  if (!validarFechaDesde()) {
    correcto = false;
  }
  if (!validarFechaHasta()) {
    correcto = false;
  }
  if (!validarPersonas()) {
    correcto = false;
  }
  if (!validarProposito()) {
    correcto = false;
  }
  validarNotas();
  if (correcto) {
    window.location.href = "instalaciones.html";
  }
  return correcto;
}

function actualizarBoton() {
  const btn = document.getElementById("btn");
  const formularioValido = validarFormulario();
  btn.disabled = !formularioValido;
}

formulario.addEventListener("submit", () => {
  if (validarFormulario()) {
    alert("Formulario enviado correctamente");
  }
});

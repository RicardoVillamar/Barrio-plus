function validarRegistro() {
    let formularioValido = true;

    const nombre = document.getElementById("nombre").value.trim();
    if (!nombre) {
        alert("El nombre de la herramienta es obligatorio.");
        formularioValido = false;
    } else if (nombre.length > 50 || !/^[a-zA-Z0-9\s]+$/.test(nombre)) {
        alert("El nombre debe ser alfanumérico y no superar 50 caracteres.");
        formularioValido = false;
    }

    const tipo = document.getElementById("tipo").value;
    if (!tipo) {
        alert("Debe seleccionar un tipo de herramienta.");
        formularioValido = false;
    }

    const cantidad = document.getElementById("cantidad").value;
    if (!cantidad || isNaN(cantidad) || cantidad < 1 || cantidad > 100) {
        alert("La cantidad debe ser un número entero entre 1 y 100.");
        formularioValido = false;
    }

    const fecha = document.getElementById("fecha").value;
    const fechaActual = new Date();
    const fechaSeleccionada = new Date(fecha);
    if (!fecha) {
        alert("La fecha de adquisición es obligatoria.");
        formularioValido = false;
    } else if (fechaSeleccionada > fechaActual) {
        alert("La fecha de adquisición no puede ser futura.");
        formularioValido = false;
    }

    const estadoSeleccionado = document.querySelector('input[name="estado"]:checked');
    if (!estadoSeleccionado) {
        alert("Debe seleccionar el estado de la herramienta.");
        formularioValido = false;
    }
    const descripcion = document.getElementById("Descripción").value.trim();
    if (descripcion.length > 200) {
        alert("La descripción no puede superar los 200 caracteres.");
        formularioValido = false;
    }

    return formularioValido;
}

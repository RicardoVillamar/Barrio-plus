function validarFormulario(){
    eliminarMensajes();

    let esValido = true;
    let nombre  = document.getElementById("nombre");   
    let nombre_titular  = document.getElementById("nombre_titular");    
    let nombreRegex = /^[a-zA-Z\s]+$/; //solo letras y espacios
    let manzana = document.getElementById("manzana");
    let manzanaRegex = /^[A-Za-z0-9]+$/; // solo numeros y letras
    let villa = document.getElementById("villa");
    let villaRegex = /^[0-9]+$/; //solo numeros
    let numero_casa = document.getElementById("numero_casa");
    let numero_casaRegex = /^[0-9]+$/;
    let numero_tarjeta = document.getElementById("numero_tarjeta");
    let numero_tarjetaRegex = /^[0-9]+$/;
    let codigo = document.getElementById("codigo");
    let codigoRegex = /^[0-9]+$/;
    let fecha_vencimiento_mes = document.getElementById("fecha_vencimiento_mes");
    let fecha_vencimiento_anio = document.getElementById("fecha_vencimiento_anio");
    let fecha_vencimiento_mesRegex =/^[0-9]{2}$/;
    let fecha_vencimiento_anioRegex =/^[0-9]{2}$/;
    const mes = parseInt(fecha_vencimiento_mes.value, 10);
    const anio = parseInt(fecha_vencimiento_anio.value, 10);
    let mensaje = "";

    //checkbox
    let productos = document.querySelectorAll('input[name="productos"]:checked'); //querySelectorAll siempre retorna un arreglo de objetos
    if(productos.length===0){
    const seleccion = document.getElementById("producto1");
    cargarMensaje("Elegir al menos 1 opcion.", seleccion);
        esValido = false;
    }

    //Select
    let selecProdu = document.getElementById("selecProdu");
    if(selecProdu.value===""){        
    cargarMensaje("Se requiere seleccionar una instalacion.", selecProdu);
        esValido = false;
    }

    let selecProdu2 = document.getElementById("selecProdu2");
    if(selecProdu2.value===""){    
     cargarMensaje("Se requiere seleccionar una herramienta.", selecProdu2);
        esValido = false;
    }

    //radio
    let pago = document.querySelector('input[name="pago"]:checked'); //querySelector retorna solo un objeto
    if(!pago){            
        let metodo_pago = document.getElementById("efectivo");
        cargarMensaje("Debe elegir un metodo de pago.", metodo_pago);       
        esValido = false;      
    }
    //efectivo 

    //Nombre
    if(nombre.value===""){       
        cargarMensaje("El nombre es requerido.", nombre);
        esValido = false;
    }else if(nombre.value.length < 3){         
        cargarMensaje("El nombre debe tener minimo 3 caracteres.", nombre);
        esValido =  false;
    }else if(!nombreRegex.test(nombre.value)){        
        cargarMensaje("El nombre no puede contener numeros.", nombre);
        esValido =  false;
    }

    //Manzana
    if(manzana.value===""){
        cargarMensaje("La manzana es requerida.", manzana);
        esValido = false;
    }else if(!manzanaRegex.test(manzana.value)){
        cargarMensaje("Solo se permiten letras y/o numeros.", manzana);
        esValido = false;
    }else if(manzana.value.length >4){
        cargarMensaje("La villa no debe pasar de 4 digitos.", manzana);
        esValido = false;
    }

    //villa
    if(villa.value===""){
        cargarMensaje("La villa es requerida.", villa);
        esValido = false;
    }else if(!villaRegex.test(villa.value)){
        cargarMensaje("Solo se permiten numeros.", villa);
        esValido = false;
    }else if(villa.value.length >3){
        cargarMensaje("La villa no debe pasar de 3 digitos.", villa);
        esValido = false;
    }

    //numero de casa

    if(numero_casa.value===""){
        cargarMensaje("El numero de casa es requerido.", numero_casa);
        esValido = false;
    }else if(!numero_casaRegex.test(numero_casa.value)){
        cargarMensaje("Solo se permiten numeros.", numero_casa);
        esValido = false;
    }else if(numero_casa.value.length >4){
        cargarMensaje("El numero de casa no debe pasar de 4 digitos.", numero_casa);
        esValido = false;
    }

    //debito

    //nombre titular
    if(nombre_titular.value===""){       
        cargarMensaje("El nombre del titular es requerido.", nombre_titular);
        esValido = false;
    }else if(nombre_titular.value.length < 3){         
        cargarMensaje("El nombre del titular debe tener minimo 3 caracteres.", nombre_titular);
        esValido =  false;
    }else if(!nombreRegex.test(nombre_titular.value)){        
        cargarMensaje("El nombre del titular no puede contener numeros.", nombre_titular);
        esValido =  false;
    }

    //numero tarjeta
    if(numero_tarjeta.value===""){
        cargarMensaje("El numero de tarjeta es requerido.", numero_tarjeta);
        esValido = false;
    }else if(!numero_tarjetaRegex.test(numero_tarjeta.value)){
        cargarMensaje("Solo se permiten numeros.", numero_tarjeta);
        esValido = false;
    }else if(numero_tarjeta.value.length <16 || numero_tarjeta.value.length >16){
        cargarMensaje("El numero de tarjeta debe tener 16 digitos.", numero_tarjeta);
        esValido = false;
    }

    //numero tarjeta
    if(codigo.value===""){
        cargarMensaje("El codigo CVV es requerido, se encuentra en la parte de atras de la tarjeta.", codigo);
        esValido = false;
    }else if(!codigoRegex.test(codigo.value)){
        cargarMensaje("Solo se permiten numeros.", codigo);
        esValido = false;
    }else if(codigo.value.length >3 || codigo.value.length <3 ){
        cargarMensaje("El codigo CVV debe tener 3 digitos.", codigo);
        esValido = false;
    }

    //fecha vencimiento:
    //mes
    if(fecha_vencimiento_mes.value===""){
        cargarMensaje("El mes de vencimiento es requerido.", fecha_vencimiento_mes);
        esValido = false;
    }else if(!fecha_vencimiento_mesRegex.test(fecha_vencimiento_mes.value)){
        cargarMensaje("Solo se permiten numeros y que contengan dos digitos.", fecha_vencimiento_mes);
        esValido = false;
    }else{
        if(mes<1||mes>12){
            cargarMensaje("El mes debe estar entre 01 a 12.", fecha_vencimiento_mes)
            esValido=false;
        }
        
    }

    //anio
    if(fecha_vencimiento_anio.value===""){
        cargarMensaje("El año de vencimiento es requerido.", fecha_vencimiento_anio);
        esValido = false;
    }else if(!fecha_vencimiento_anioRegex.test(fecha_vencimiento_anio.value)){
        cargarMensaje("Solo se permiten numeros y que contengan dos digitos.", fecha_vencimiento_anio);
        esValido = false;
    }else{
        if(anio<25||mes>30){
            cargarMensaje("El año debe estar entre 25 a 30.", fecha_vencimiento_anio)
            esValido=false;
        }        
    }
    return esValido;
    
}

function cargarMensaje(mensaje, elemento){
    elemento.focus();
    let span = document.createElement("span"); // se crea en memoria el elemento
    span.textContent = mensaje;   
    span.classList.add("error");
    elemento.parentNode.appendChild(span);
}

function eliminarMensajes(){
    let arrSpan = document.querySelectorAll(".error"); //siempre retorna un arreglo el queryselectoAll
    for(let i=0;i<arrSpan.length;i++){   
        arrSpan[i].remove(); //remove() eliminar un elemento
    }    
}

document.addEventListener("DOMContentLoaded", function(){
    const rdbEfectivo = document.getElementById("efectivo");
    const rdbDebito = document.getElementById("debito");

    const cmpEfectivo = [
        document.getElementById("nombre"),
        document.getElementById("manzana"),
        document.getElementById("villa"),
        document.getElementById("numero_casa"),
    ];

    const cmpDebito = [
        document.getElementById("nombre_titular"),
        document.getElementById("numero_tarjeta"),
        document.getElementById("codigo"),
        document.getElementById("fecha_vencimiento_mes"),    
        document.getElementById("fecha_vencimiento_anio"),            
    ];

    function deshabilitarCampos(){
        if(rdbEfectivo.checked){
            cmpEfectivo.forEach(campo => campo.disabled = false);
            cmpDebito.forEach(campo=>campo.disabled = true);
        }else if(rdbDebito.checked){
            cmpEfectivo.forEach(campo => campo.disabled = true);
            cmpDebito.forEach(campo=>campo.disabled = false);
        }
    }

    rdbEfectivo.addEventListener("change", deshabilitarCampos);
    rdbDebito.addEventListener("change", deshabilitarCampos);

    deshabilitarCampos();
});

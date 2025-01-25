<!-- Autor: Larrea Rosales Alejandro Sebastian -->
<?php require_once HEADER; ?>
<div class="contenedorForm">
      <form action="" id="formulario">
        <div>
          <h2>Contribucion</h2>                   
        </div>
        <div class="campo">              
          <label for="">Contribuir a:</label>        
          <input type="checkbox" id="producto1" name="productos" value="instalaciones">
          <label for="producto1">Instalaciones</label>
          <input type="checkbox" id="producto2" name="productos" value="herramientas">
          <label for="producto2">Herramientas</label>
        </div>  
        <div class="campo">
          <label for="selecProdu">Seleccione instalación</label>        
          <select name="selecProdu" id="selecProdu" class="selecProductos">
            <option value="">Seleccione instalación...</option>
            <option value="capilla">Capilla</option> 
            <option value="salon_comunal">Salón Comunal</option>  
            <option value="cancha_golf">Cancha de Golf</option>       
            <option value="area_recreativa">Área Recreativa</option>   
          </select>
        </div>
        
        <div class="campo">
          <label for="selecProdu2">Seleccione herramienta:</label>
          <select name="selecProdu2" id="selecProdu2" class="selecProductos"> 
            <option value="">Seleccione herramienta...</option>
            <option value="llave_maestra">Llave Maestra</option> 
            <option value="podadora">Podadora</option>  
            <option value="gata">Gata</option>       
            <option value="asador">Asador</option> 
          </select>
        </div>
        <div class="campo">
          <label for="">Seleccione metodo de pago:</label>
          <input type="radio" id="efectivo" name="pago" value="efectivo"/>
          <label for="efectivo">Efectivo</label>
          <input type="radio" id="debito" name="pago" value="debito"/>
          <label for="debito">Debito</label>
        </div>
        <div>
          <h4>Efectivo:</h4>
        <div class="campo">
        <label for="nombre">Ingrese su nombre:</label>
          <input type="text" name="nombre" id="nombre" placeholder="Alejandro Larrea"/> 
        </div>
        <div class="campo">
          <label for="manzana">Ingrese la manzana de la casa:</label>       
          <input type="text" name="manzana" id="manzana" placeholder="A21"/>  
        </div>
        <div class="campo">
          <label for="villa">Ingrese la villa de la casa: </label>        
          <input type="text" name="villa" id="villa" placeholder="253"/>  
        </div>   
        <div class="campo">
          <label for="numero_casa">Ingrese el numero de casa:</label>
          <input type="text" name="numero_casa" id="numero_casa" placeholder="2519"/>
        </div>
        
          <h4>Debito:</h4>
        <div class="campo">
          <label for="nombre_titular">Nombre Titular </label> <br>            
          <input type="text" name="nombre_titular" id="nombre_titular" placeholder="ALEJANDRO LARREA"/>
        </div>
        <div class="campo">
          <label for="numero_tarjeta">Numero de la Tarjeta</label>
        </br>
          <input type="text" name="numero_tarjeta" id="numero_tarjeta" placeholder="0000 1111 2222 4444"/>
        </div>
        <div class="campo">
          <label for="fecha_vencimiento">Fecha de Vencimiento</label>
        </br>
          <input style="width: 40px;" type="text" name="fecha_vencimiento_mes" id="fecha_vencimiento_mes" placeholder="01"/>
          <input style="width: 40px"; type="text" name="fecha_vencimiento_anio" id="fecha_vencimiento_anio" placeholder="27">
        </div>             
        <div class="campo">
          <label for="codigo">Codigo CVV</label>
        </br>
          <input style="width: 30px" type="text" name="codigo" id="codigo" placeholder="007">
        </div>
      </div>
        <div id="botones">        
          <button class="boton-mediano" type="submit">Guardar</button>
          <button class="boton-mediano" type="reset">Cancelar</button> 
      </div>    
      </form>
    </div>    
<?php require_once FOOTER; ?>
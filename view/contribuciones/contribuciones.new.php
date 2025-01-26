<!-- Autor: Larrea Rosales Alejandro Sebastian -->
<?php require_once HEADER; ?>
<div class="contenedorForm">
      <form action="" id="formulario">
        <div>
          <h2>Contribucion</h2>                   
        </div>

        <div class="campo">              
          <label>Contribuir a: </label><br>
            <input type="radio" id="instalaciones" name="recurso" value="instalaciones">
            <label for="instalaciones">Instalaciones</label>
            <input type="radio" id="herramientas" name="recurso" value="herramientas">
            <label for="herramientas">Herramientas</label>
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

        <input type="hidden" name="idUsuario" id="idUsu" 
        value="<?php echo $idUsu = $usuario['idUsuario']; ?>"/>
        
        <div id="botones">        
          <button class="boton-mediano" type="submit">Guardar</button>
          <button class="boton-mediano" type="reset">Cancelar</button> 
      </div>    
      </form>
</div>
<?php require_once FOOTER; ?>
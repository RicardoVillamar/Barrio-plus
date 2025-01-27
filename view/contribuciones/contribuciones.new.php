<!-- Autor: Larrea Rosales Alejandro Sebastian -->
<?php require_once HEADER; ?>
<div class="contenedorForm">
      <form action="" id="formulario">
        <div>
          <h2><?php echo $titulo ?></h2>                   
        </div>

        <div class="campo">              
          <label>Contribuir a: </label><br>
          <input type="radio" id="instalaciones" name="recurso" value="instalaciones" onclick="mostrarCombo()">
          <label for="instalaciones">Instalaciones</label>
          <input type="radio" id="herramientas" name="recurso" value="herramientas" onclick="mostrarCombo()">
          <label for="herramientas">Herramientas</label>
        </div>
                
        <div class="campo" id="campoInstalaciones" style="display: none;">
          <label for="selectInstalaciones">Seleccione instalación: </label>        
          <select name="selectInstalaciones" id="selectInstalaciones" class="selecProductos">
            <?php 
            foreach($instalaciones as $ins){
            ?>
            <option value="<?php echo $ins["idInstalacion"]?>">
              <?php echo $ins["nombre_instalacion"]?></option>
            <?php } ?>
          </select>
        </div>

        <div class="campo" id="campoHerramientas" style="display: none;">
          <label for="selectHerramientas">Seleccione herramienta: </label>        
          <select name="selectHerramientas" id="selectHerramientas" class="selecProductos">
            <?php 
            foreach($herramientas as $herr){
            ?>
            <option value="<?php echo $herr["idHerramienta"]?>">
              <?php echo $herr["nombre"]?></option>
            <?php } ?>
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
<script>
  function mostrarCombo() {
    const instalacionesRadio = document.getElementById('instalaciones');
    const herramientasRadio = document.getElementById('herramientas');
    const campoInstalaciones = document.getElementById('campoInstalaciones');
    const campoHerramientas = document.getElementById('campoHerramientas');
    
    if (instalacionesRadio.checked) {
      campoInstalaciones.style.display = 'block';
      campoHerramientas.style.display = 'none';
    } else if (herramientasRadio.checked) {
      campoHerramientas.style.display = 'block';
      campoInstalaciones.style.display = 'none';
    }
  }
</script>
<?php require_once FOOTER; ?>
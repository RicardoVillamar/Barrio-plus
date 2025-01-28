<!-- Autor: Larrea Rosales Alejandro Sebastian -->
<?php require_once HEADER; ?>

<style>
   .contenedorForm {
    max-width: 500px;
    margin: auto;
    padding: 20px;
    background-color: #f4f4f4;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.contenedorForm h2 {
    font-size: x-large;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: #555;
    text-align: center;
    margin-bottom: 20px;
}

.campo {
    margin-bottom: 20px;
}

.campo label {
    display: inline-block; 
    margin-right: 10px; 
    font-weight: bold;
    color: #555;
    margin-bottom: 0; 
}

.campo input[type="radio"] {
    vertical-align: middle; 
    margin-right: 5px; 
}

.selecProductos {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

#botones {
    text-align: center;
}
</style>

<div class="contenedorForm">
      <form method="POST" action="index.php?c=contribucion&f=new" id="formContribuciones">
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

        <div class="campo" id="campoEstado" style="display: none;">
        <label for="campoEstadoContr">Estado contribución: </label>
        <select name="campoEstadoContr" id="selectInstalaciones" class="selecProductos">
          <?php 
          foreach ($estadosContrib as $est) {
            $selected = "";
            if($est["idEstadoContribucion"] == 1){
              $selected = 'selected = "selected"';
            }
          ?>
          <option value="<?php echo $est["idEstadoContribucion"] ?>" <?php echo $selected; ?>>
            <?php echo $est["nombreEstado"] ?>
          </option>
          <?php } ?>
        </select>
      </div>

        <input type="hidden" name="idUsuario" id="idUsu" 
        value="<?php echo $idUsu = $usuario['idUsuario']; ?>"/>

        <div id="botones">        
          <button type="submit" class="boton-mediano" type="submit">Guardar</button>
          <a href="index.php?c=contribucion&f=index"
            class="boton-mediano">
            Cancelar
          </a>
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
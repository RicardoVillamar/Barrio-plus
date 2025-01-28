<!-- Autor: Larrea Rosales Alejandro Sebastian -->
<?php require_once HEADER; ?>
<div class="contenedorForm">
    <form method="POST" action="index.php?c=contribucion&f=edit" id="formContribuciones">
        <div>
            <h2><?php echo $titulo; ?></h2>
        </div>

        <input type="hidden" name="id" value="<?php echo htmlentities($contribu['idContribucion']); ?>">

        <div class="campo">
            <label>Contribuir a: </label><br>
            <?php 
            $checkedInstalaciones = $contribu['idInstalacionFK'] ? 'checked' : '';
            $checkedHerramientas = $contribu['idHerramientaFK'] ? 'checked' : '';
            ?>
            <input type="radio" id="instalaciones" name="recurso" value="instalaciones" onclick="mostrarCombo()" <?php echo $checkedInstalaciones; ?>>
            <label for="instalaciones">Instalaciones</label>
            <input type="radio" id="herramientas" name="recurso" value="herramientas" onclick="mostrarCombo()" <?php echo $checkedHerramientas; ?>>
            <label for="herramientas">Herramientas</label>
        </div>

        <div class="campo" id="campoInstalaciones" style="display: <?php echo $checkedInstalaciones ? 'block' : 'none'; ?>;">
            <label for="selectInstalaciones">Seleccione instalación: </label>        
            <select name="selectInstalaciones" id="selectInstalaciones" class="selecProductos">
                <?php 
                foreach($instalaciones as $ins){
                    $selected = $ins["idInstalacion"] == $contribu['idInstalacionFK'] ? 'selected' : '';
                ?>
                <option value="<?php echo $ins["idInstalacion"]?>" <?php echo $selected; ?>>
                    <?php echo $ins["nombre_instalacion"]?>
                </option>
                <?php } ?>
            </select>
        </div>

        <div class="campo" id="campoHerramientas" style="display: <?php echo $checkedHerramientas ? 'block' : 'none'; ?>;">
            <label for="selectHerramientas">Seleccione herramienta: </label>        
            <select name="selectHerramientas" id="selectHerramientas" class="selecProductos">
                <?php 
                foreach($herramientas as $herr){
                    $selected = $herr["idHerramienta"] == $contribu['idHerramientaFK'] ? 'selected' : '';
                ?>
                <option value="<?php echo $herr["idHerramienta"]?>" <?php echo $selected; ?>>
                    <?php echo $herr["nombre"]?>
                </option>
                <?php } ?>
            </select>
        </div>

        <div class="campo">
            <label for="campoEstadoContr">Estado contribución: </label>
            <select name="campoEstadoContr" id="campoEstadoContr" class="selecProductos">
                <?php 
                foreach ($estadosContrib as $est) {
                    $selected = $est["idEstadoContribucion"] == $contribu['idEstadoContribucionFK'] ? 'selected' : '';
                ?>
                <option value="<?php echo $est["idEstadoContribucion"] ?>" <?php echo $selected; ?>>
                    <?php echo $est["nombreEstado"] ?>
                </option>
                <?php } ?>
            </select>
        </div>

        <input type="hidden" name="idUsuario" id="idUsu" 
        value="<?php echo $contribu["idUsuarioFK"]?>"/>

        <div id="botones">        
            <button type="submit" class="boton-mediano">Guardar Cambios</button>
            <a href="index.php?c=contribucion&f=index" class="boton-mediano">Cancelar</a>
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

<?php require_once FOOTER; ?>
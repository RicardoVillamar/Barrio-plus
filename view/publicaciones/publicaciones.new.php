<!-- Autor: Freire Chavez Jose Andres -->
<?php require_once HEADER; ?>
<section class="publicaciones">
  <form
    action="index.php?c=publicacion&f=new"
    method="POST"
    name="formPublicNuevo"
    id="formPublicNuevo">
    
    <h2 class="subtitulos">Información de la publicación</h2>
    <div class="tituloPublicacion">
      <label for="titulo_publicacion">Título de la publicación:</label><br>
      <input
        type="text"
        id="titulo_publicacion"
        name="nombre"
        placeholder="Ingrese un título">
    </div>

    <div class="tipoPublicacion">
      <label for="tipo_publicacion">Tipo de publicación:</label><br>
      <select name="tipo_publicacion" id="tipo_publicacion">
        <?php 
          foreach($tiposPublicaciones as $tipoPubli){
        ?>
        <option value="<?php echo $tipoPubli["idTipo"]?>">
          <?php echo $tipoPubli["nombreTipo"]?></option>
        <?php } ?>
      </select>
    </div>

    <div class="campoDescripcion">
      <label for="descripcion">Descripción:</label><br>
      <textarea
        id="descripcion"
        class="publicacionDescripcion"
        name="descripcion"
        placeholder="Escribe la descripción de la publicación"></textarea>
    </div>

    <label>Seleccione la prioridad de la publicación: </label><br>
    <div class="grupoRadio">
      <?php foreach ($prioridades as $prio) { ?>
        <input 
          type="radio" 
          id="prioridad_<?php echo $prio["idPrioridad"]?>" 
          name="prioridad" 
          value="<?php echo $prio["idPrioridad"]?>">
        <label for="prioridad_<?php echo $prio["idPrioridad"]?>"><?php echo $prio["nivel"]?></label>
      <?php } ?>
    </div>

    <div class="campoFechaPublicacion">
      <label for="fecha_publicacion">Fecha del evento:</label><br>
      <input
        type="date"
        id="fecha_publicacion"
        name="fecha_publicacion">
    </div>

    <input type="hidden" name="idUsuario" id="idUsu" 
      value="<?php echo $idUsu = $usuario['idUsuario']; ?>"/>
    
    <div class="campoCheckbox">
      <input
        type="checkbox"
        id="soloAdmins"
        name="notificarSoloAdmins"
      >
      <label for="soloAdmins">Notificar solo a los administradores</label>
    </div>

    <div class="grupoBotones">
      <button
        style="font-size: 0.8rem"
        type="submit"
        class="boton-pequenio">
        Guardar
      </button>

      <a href="index.php?c=publicacion&f=index"
        style="font-size: 0.8rem"
        class="boton-pequenio">
        Cancelar
      </a>
    </div>
  </form>

  <div class="imagenComunidad">
    <img
      src="https://img.freepik.com/free-vector/online-community_24877-50878.jpg?t=st=1732315953~exp=1732319553~hmac=759028a5b586a885341d0d7b5459d46da54da2a602fece2edd57652ea53d4d07&w=740"
      alt="imagen-comunidad">
  </div>
</section>
<?php require_once FOOTER; ?>
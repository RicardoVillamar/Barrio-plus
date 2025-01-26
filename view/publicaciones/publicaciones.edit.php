<!-- Autor: Freire Chavez Jose Andres -->
<?php require_once HEADER; ?>
  <section class="publicaciones">
    <form 
        action="index.php?c=publicacion&f=edit" 
        method="POST" 
        name="formPublicNuevo"
        id="formPublicNuevo"
        style="margin-top: 30px;"
    >
      <h2 style="margin-bottom: 10px;" class="subtitulos">Información de la publicación</h2>
      <input type="hidden" name="id" id="id" value="<?php echo $publi["idPubli"]?>"/>
      <div class="tituloPublicacion">
        <label for="titulo_publicacion">Título de la publicación:</label
        ><br>
        <input
          type="text"
          id="titulo_publicacion"
          name="nombre"
          value="<?php echo $publi["titulo"]?>"
          placeholder="Ingrese un título"
        >
      </div>

      <div class="tipoPublicacion">
      <label for="tipo_publicacion">Tipo de publicación:</label><br>
      <select name="tipo_publicacion" id="tipo_publicacion">
        <?php 
          foreach($tiposPublicaciones as $tipoPubli){
            $selected = "";
            if($tipoPubli["idTipo"] == $publi["idTipoFK"]){
              $selected = 'selected = "selected"';
            }
        ?>
        <option <?php echo $selected ?> value="<?php echo $tipoPubli["idTipo"]?>">
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
          placeholder="Escribe la descripción de la publicación"
        ><?php echo $publi["descripcion"]?></textarea>
      </div>

      <label>Seleccione la prioridad de la publicación: </label
      ><br>
      <div class="grupoRadioPriori">
        <?php foreach ($prioridades as $prio) { 
          $checked = "";
          if($prio["idPrioridad"] == $publi["idPrioridadFK"]){
            $checked = 'checked = "checked"';
          }  
        ?>
          <input 
            type="radio" 
            id="prioridad_<?php echo $prio["idPrioridad"]?>" 
            name="prioridad" 
            value="<?php echo $prio["idPrioridad"]?>"
            <?php echo $checked ?>
            >
          <label for="prioridad_<?php echo $prio["idPrioridad"]?>"><?php echo $prio["nivel"]?></label>
        <?php } ?>
      </div>

      <div class="campoFechaPublicacion">
        <label for="fecha_publicacion">Fecha del evento:</label><br>
        <input
          type="date"
          id="fecha_publicacion"
          name="fecha_publicacion"
          value="<?php echo $publi["fechaEvento"]?>"
        >
      </div>

      <input type="hidden" name="idUsuario" id="idUsu" 
      value="
      <?php if(!isset($_SESSION)){session_start();}
        if(isset($_SESSION['usuario'])){
          $usuario = $_SESSION['usuario'];
          echo $idUsu = $usuario['idUsuario'];
        }
      ?>
      "/>

      <div style="margin-bottom:20px;" class="campoCheckbox">
        <input
          style="margin-left:0px; width: 20px;"
          type="checkbox"
          id="soloAdmins"
          name="notificarSoloAdmins"
          value="<?php echo $publi["notificarAdmin"]?>"
          <?php echo ($publi["notificarAdmin"]==1)?'checked = "checked"':""?>>
        <label style="margin-left:10px;" for="soloAdmins">Notificar solo a los administradores</label>
      </div>

      <div class="grupoBotonesPubli">
        <button
          style="font-size: 0.8rem;  width: 38%; border-radius: 10px;"
          type="submit"
          class="boton-pequenio"
          onclick="if(!confirm('Esta seguro de modificar la publicación?')) return false;"
        >
          Guardar cambios
        </button>

        <a href="index.php?c=publicacion&f=index"
          style="font-size: 0.8rem;  width: 38%; border-radius: 10px;"
          class="boton-pequenio">
          Cancelar
        </a>
      </div>
    </form>

    <div class="imagenComunidad">
      <img
        src="https://img.freepik.com/free-vector/online-community_24877-50878.jpg?t=st=1732315953~exp=1732319553~hmac=759028a5b586a885341d0d7b5459d46da54da2a602fece2edd57652ea53d4d07&w=740"
        alt="imagen-comunidad"
        style="margin-top: 30px;"
      >
    </div>
  </section>
<?php require_once FOOTER; ?>
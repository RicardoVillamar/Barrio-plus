<?php require_once HEADER; ?>
      <h1 class="titulos">Publicaciones</h1>
      <section class="publicaciones">
        <form 
            action="index.php?c=productos&f=new" 
            method="POST" 
            name="formPublicNuevo"
            id="formPublicNuevo"
        >
          <h2 class="subtitulos">Información de la publicación</h2>
          <div class="tituloPublicacion">
            <label for="titulo_publicacion">Título de la publicación:</label
            ><br>
            <input
              type="text"
              id="titulo_publicacion"
              name="nombre"
              placeholder="Ingrese un título"
            >
          </div>

          <div class="tipoPublicacion">
            <label for="tipo_publicacion">Tipo de publicación:</label><br>
            <select name="tipo_publicacion" id="tipo_publicacion">
              <option value="">Seleccione...</option>
              <option value="reporteDanios">Reporte de daños</option>
              <option value="avisosGenerales">Avisos generales</option>
              <option value="avisosMantenimiento">
                Avisos de mantenimiento
              </option>
              <option value="solicitudesRecursos">
                Solicitudes de recursos
              </option>
              <option value="otros">Otros</option>
            </select>
          </div>

          <div class="campoDescripcion">
            <label for="descripcion">Descripción:</label><br>
            <textarea
              id="descripcion"
              class="publicacionDescripcion"
              name="descripcion"
              placeholder="Escribe la descripción de la publicación"
            ></textarea>
          </div>

          <label>Seleccione la prioridad de la publicación: </label
          ><br>
          <div class="grupoRadio">
            <input type="radio" id="alta" name="prioridad" value="alta">
            <label for="alta">Alta</label>
            <input type="radio" id="media" name="prioridad" value="media">
            <label for="media">Media</label>
            <input type="radio" id="baja" name="prioridad" value="baja">
            <label for="baja">Baja</label>
          </div>

          <div class="campoFechaPublicacion">
            <label for="fecha_publicacion">Fecha del evento:</label><br>
            <input
              type="date"
              id="fecha_publicacion"
              name="fecha_publicacion"
            >
          </div>

          <h2 class="subtitulos">Información del publicante</h2>
          <div class="campoNombre">
            <label for="nombre">Nombres:</label><br>
            <input
              type="text"
              id="nombre"
              name="nombre"
              placeholder="Ingrese su nombre"
            >
          </div>

          <div class="campoTelefono">
            <label for="telefono">Teléfono:</label><br>
            <input
              type="tel"
              id="telefono"
              name="telefono"
              placeholder="Ingrese su número telefónico"
            >
          </div>

          <div class="campoCorreo">
            <label for="correo">Correo:</label><br>
            <input
              type="email"
              id="correo"
              name="correo"
              placeholder="Ingrese su correo"
            >
          </div>

          <div class="campoCheckbox">
            <input
              type="checkbox"
              id="soloAdmins"
              name="notificarSoloAdmins"
              value="Solo administradores"
            >
            <label for="soloAdmins">Notificar solo a los administradores</label>
          </div>

          <div class="grupoBotones">
            <button
              style="font-size: 0.8rem"
              type="submit"
              class="boton-pequenio"
            >
              Enviar
            </button>

            <button
              style="font-size: 0.8rem"
              type="reset"
              class="boton-pequenio"
            >
              Cancelar
            </button>
          </div>
        </form>

        <div class="imagenComunidad">
          <img
            src="https://img.freepik.com/free-vector/online-community_24877-50878.jpg?t=st=1732315953~exp=1732319553~hmac=759028a5b586a885341d0d7b5459d46da54da2a602fece2edd57652ea53d4d07&w=740"
            alt="imagen-comunidad"
          >
        </div>
      </section>
<?php require_once FOOTER; ?>
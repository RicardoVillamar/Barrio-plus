<?php
  if (!isset($_SESSION)) session_start();
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/homeStyle.css">
    <link rel="icon" href="assets/images/fotos/logo-icon.png" type="image/png">
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
      rel="stylesheet"
    />
    <title>Home</title>
  </head>
  <body>
    <?php require_once HEADER; ?>
    <section class="contenedorBanner">
      <div class="banner">
        <h1 id="textoBanner">Barrio Plus</h1>
      </div>
    </section>

    <div
      id="informacion"
      style="
        font-weight: bold;
        background-color: #a3b5c8;
        color: #4a4a4a;
        padding: 10px;
        font-size: 1em;
      "
    >
      ¡Bienvenido a Barrio Plus un Sistema de Gestion de Recursos Comunitarios!
      Puedes revisar las instalaciones y herramientas reservadas recientes aqui
      abajo
    </div>

    <section class="contenedorInstalaciones">
      <h3>Instalaciones Reservadas Recientes</h3>
      <div class="elementoReservar">
        <button class="boton-mediano">Reservar...</button>
      </div>

      <div class="elementos">
        <img
          src="assets/images/fotos/comunidad.jpg"
          alt="Instalacion Reservada"
          id="cancha"
        />
        <span>Cancha de Futbol</span>
        <span>Reservado hasta: 20/11/2024</span>
      </div>

      <div class="elementos">
        <img
          src="assets/images/fotos/sala.jpeg"
          alt="Instalacion Reservada"
          id="sala"
        />
        <span>Sala de eventos</span>
        <span>Reservado hasta: 21/11/2024</span>
      </div>
    </section>

    <section class="contenedorHerramientas">
      <h3>Herramientas Reservadas Recientes</h3>
      <div class="elementoReservar">
        <button class="boton-mediano">Reservar...</button>
      </div>

      <div class="elementos">
        <img
          src="assets/images/fotos/podadora.jpeg"
          alt="Herramienta Reservada"
          id="podadora"
        />
        <span>Podadora</span>
        <span>Reservado hasta: 19/11/2024</span>
      </div>

      <div class="elementos">
        <img
          src="assets/images/fotos/escalera.jpeg"
          alt="Herramientas Reservada"
          id="escalera"
        />
        <span>Escalera</span>
        <span>Reservado hasta: 20/11/2024</span>
      </div>
    </section>

    <section
      id="adicional"
      style="width: 90%; margin: auto; padding: 10px; border: 3px solid #a3b5c8"
    >
      <details>
        <summary style="font-weight: bold; cursor: pointer">
          Informacion Adicional sobre los recursos de la Comunidad
        </summary>
        <p>
          La comunidad cuenta con varias instalaciones y herramientas puestas a
          disposición para reservar. Contamos con canchas deportivas, sala de
          eventos, parques, herramientas de mantenimiento y áreas recreativas.
          Recuerda revisar la disponibilidad y reservar dando un solo clic.
        </p>
      </details>
    </section>

    <section class="sobreNosotros">
      <div class="imgNosotros">
        <img src="assets/images/fotos/nosotros.png" alt="Nosotros" id="imgNos" />
        <div class="lema" style="display: none">
          "Facilitando el acceso, fortaleciendo la comunidad"
        </div>
      </div>
      <div class="nosotros">
        <h3>Grupo 6</h3>
        <p>
          El Sistema de Gestión de Recursos Comunitarios nació con la idea de
          facilitar la vida en la comunidad, permitiendo a los vecinos de un
          barrio o urbanización compartir y administrar recursos de manera
          eficiente. Este sistema brinda una plataforma donde cada miembro puede
          consultar la disponibilidad de instalaciones y herramientas comunes,
          realizar reservas y ver el historial de uso. Así, fomentamos una
          convivencia organizada para el uso de espacios y recursos, promoviendo
          un sentido de responsabilidad compartida en el cuidado de los bienes
          comunes.
        </p>
        <button class="boton-grande">Más información aquí...</button>
      </div>
    </section>

    <section id="publicacionesRecientes">
      <h3 style="background-color: #f0f4f8">Publicaciones Recientes</h3>
      <?php 
          foreach($publicaciones as $publ){
      ?>
      <div id="contenedorPub">
        <div class="comentarios">
          <div class="user">
            <img
              class="imgUsuario"
              src="assets/images/fotos/images.jpeg"
              alt="usuario"
            />
            <h5><?php echo $publ['nombre'] . " " .$publ['apellido']?></h5>
          </div>
          <p>
            <?php echo $publ['descripcion']?>
          </p>
        </div>
        <?php } ?>
      </div>
    </section>

    <section id="contribucion">
      <h3>Contribuciones</h3>
      <div id="contenedorCont">
        <h5 style="font-size: medium">Deseas contribuir en la comunidad?</h5>
        <p>
          Con un solo clic, puedes contribuir, asi podemos entre todos los
          miembros de la comunidad ampliar nuestra gama de herramientas e
          instalaciones para el servicio y comodidad de la comunidad, presiona
          clic en el boton de abajo.
        </p>
        <button class="boton-mediano">
          <a href="pages/homes/contribucion_form.html">Contribuir</a>
        </button>
      </div>
    </section>
<?php require_once FOOTER; ?>
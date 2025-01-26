<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/nosotrosStyle.css">
    <link rel="icon" href="assets/images/fotos/logo-icon.png" type="image/png">
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
      rel="stylesheet"
    />
    <title>Nosotros</title>
  </head>
  <body>
    <?php require_once HEADER; ?>
    <main class="contenedor-principal">
      <section style="margin-top: 10px; border-radius: 15px;" id="acercaDenosotros">
        <h1 class="titulos">Acerca de Nosotros</h1>
        <p class="texto">
          Somos una plataforma dedicada a <strong>fortalecer</strong> el sentido
          de comunidad y colaboración en el vecindario. Nuestro sistema de
          gestión de recursos permite a los vecinos acceder y
          <strong>organizar</strong> el uso de instalaciones y herramientas
          compartidas de manera eficiente y transparente. Creemos que, a través
          de la colaboración, podemos <strong>facilitar</strong> el acceso a
          recursos comunes, optimizar su uso y promover una cultura de
          <strong>respeto</strong> y
          <strong>responsabilidad</strong> compartida. 
        </p>
        <blockquote
          cite="https://psicologiaymente.com/reflexiones/frases-colaboracion"
        >
          <em
            >La solidaridad no es un acto de caridad, sino ayuda mutua entre
            fuerzas que luchan por el mismo objetivo.</em
          >
        </blockquote>
        <figure>
          <img
            src="https://www.unidadvictimas.gov.co/wp-content/uploads/2024/07/abre-humanitaria-guajira-1.jpg"
            style="width: 100%; height: 10%"
            alt="ayudaComunitaria"
          />

          <figcaption>
            <em>
              <time datetime="2024-11-09">9 de noviembre de 2024</time>: Entrega
              y organización de recursos comunitarios en una jornada de apoyo a
              una comunidad.
            </em>
            <address>
              Contacto: <a id="enlaceSeccion" href="#contacto">Contáctanos</a
              ><br />
              Avenida Barcelona, Guayaquil, Ecuador
            </address>
          </figcaption>
        </figure>
      </section>

      <section style="margin-top: 10px; margin-left: 0px; border-radius: 15px;" class="container">
      <h2 style="margin-top: 20px; margin-bottom: 20px; display:block; width:130px; text-decoration: none;" class="titulos">Integrantes</h2>  
      <section class="row">
          <article class="tarjeta col-md-3">
            <img
              src="assets/images/grupo/villamar.png"
              alt="villamar"
              class="tarjeta-imagen"
            />
            <div class="infoIntegrante">
              <p class="tarjeta-titulo">Villamar Minuche Ricardo Daniel</p>
              <span class="integrante"> </span>
              <p class="texto">
                <b>Especialización: </b><br/>Diseñador UX/UI busca crear
                interfaces gráficas intuitivas para todas las personas.<br /><b>
                Aportaciones: </b><br/>Página html instalaciones y formulario para reservar
                instalaciones.
              </p>
            </div>
          </article>

          <article class="tarjeta col-md-3">
            <img
              src="assets/images/grupo/quinionez.png"
              alt="quinionez"
              class="tarjeta-imagen"
            />
            <div class="infoIntegrante">
              <p class="tarjeta-titulo">Quiñonez Castrellón Anthony Joel</p>
              <span class="integrante"> </span>
              <p class="texto">
                <b>Especialización: </b><br>Gestión de base de datos
                relacionales y no relacionales como Oracle y MongoDB.<br/>
                <b>Aportaciones:</b>Página html herramientas y formulario 
                para reservar herramientas.
              </p>
            </div>
          </article>

          <article class="tarjeta col-md-3">
            <img
              src="assets/images/grupo/palacios.png"
              alt="palacios"
              class="tarjeta-imagen"
            />
            <div class="infoIntegrante">
              <p class="tarjeta-titulo">Palacios Herdoiza Roitman Andres</p>
              <span class="integrante"> </span>
              <p class="texto">
                <b>Especialización: </b><br />Recolección y análisis de datos
                usando python, PowerBI y RStudio.<br /><b>Aportaciones: </b
                ><br />
                Página html historial y formulario para registrar herramientas.
              </p>
            </div>
          </article>
        </section>

        <section class="row">
          <article class="tarjeta col-md-3">
            <img
              src="assets/images/grupo/larrea.png"
              alt="larrea"
              class="tarjeta-imagen"
            />
            <div class="infoIntegrante">
              <p class="tarjeta-titulo">Larrea Rosales Alejandro Sebastián</p>
              <span class="integrante"> </span>
              <p class="texto">
                <b>Especialización: </b><br />Desarrollador frontend usando
                JavaScript, HTML5, React.js y Angular.<br /><b>Aportaciones: </b
                ><br />
                Página html home y formulario de contribuciones.
              </p>
            </div>
          </article>

          <article class="tarjeta col-md-3">
            <img
              src="assets/images/grupo/freire.png"
              alt="freire"
              class="tarjeta-imagen"
            />
            <div class="infoIntegrante">
              <p class="tarjeta-titulo">Freire Chávez José Andrés</p>
              <span class="integrante"> </span>
              <p class="texto">
                <b>Especialización: </b><br />Desarrollador backend usando
                Node.js, Django y Laravel.<br /><b>Aportaciones: </b><br />
                Página html nosotros y formulario de publicaciones.
              </p>
            </div>
          </article>
        </section>
      </section>

      <section style="margin-top: 10px; border-radius: 15px;" id="historia">
        <h2 class="titulos">Historia</h2>
        <p class="texto">
          Este proyecto nació de la necesidad de un grupo de vecinos que querían
          mejorar el acceso a recursos comunes en su comunidad, simplificando la
          organización y evitando malentendidos o conflictos. Con la tecnología
          como aliada, decidimos crear un sistema que hiciera posible gestionar,
          reservar y compartir estos recursos de forma accesible y sencilla para
          todos. Con el tiempo, la plataforma ha evolucionado, y gracias al
          apoyo de los usuarios, hoy es un sistema que fomenta el respeto mutuo
          y el bienestar de la comunidad.
        </p>
      </section>

      <section style="margin-top: 10px; border-radius: 15px;" id="mision">
        <h2 class="titulos">Misión</h2>
        <p class="texto">
          Nuestra visión es construir una comunidad conectada y solidaria donde
          los recursos compartidos se utilicen de manera responsable y efectiva,
          promoviendo una red de apoyo y colaboración vecinal. Buscamos que, con
          nuestro sistema, cada comunidad pueda aprovechar al máximo sus
          recursos, impulsando un modelo sostenible y responsable que sirva de
          ejemplo para otros vecindarios.
        </p>
        <div class="videos">
          <iframe
            src="https://www.youtube.com/embed/WS_TjVy_kVw?si=eJJXtDYyLaGkRo9z"
            title="YouTube video player"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen
            class="video-iframe"
          ></iframe>

          <iframe
            src="https://www.youtube.com/embed/xwpsYSOQjpE?si=rp0gPccLqjyTBGAy"
            title="YouTube video player"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen
            class="video-iframe"
          ></iframe>
        </div>
      </section>

      <section style="margin-top: 10px; height: 380px; border-radius: 15px;" id="valores">
        <h2 class="titulos">Valores</h2>
        <div id="listaValores">
          <ul>
            <li>
              <p class="texto">
                <b>Colaboración:</b> Creemos que el trabajo en equipo y la
                <mark>cooperación</mark> son claves para el bienestar común.
              </p>
            </li>
            <li>
              <p class="texto">
                <b>Transparencia:</b> Promovemos un
                <mark>sistema claro y accesible</mark>, donde cada usuario pueda
                conocer la disponibilidad y el uso de los recursos.
              </p>
            </li>
            <li>
              <p class="texto">
                <b>Responsabilidad:</b> Fomentamos el respeto hacia los
                <mark>recursos compartidos</mark> y el cumplimiento de las
                normas comunitarias.
              </p>
            </li>
            <li>
              <p class="texto">
                <b>Innovación al servicio de la comunidad:</b> Usamos la
                tecnología para
                <mark>facilitar y mejorar la convivencia</mark> y gestión de
                recursos en el entorno vecinal.
              </p>
            </li>
            <li>
              <p class="texto">
                <b>Sostenibilidad:</b> Queremos optimizar el uso de los
                recursos, promoviendo el
                <mark>cuidado del medio ambiente</mark> y evitar el desperdicio.
              </p>
            </li>
          </ul>
          <img
            src="https://blogs.iadb.org/ciudades-sostenibles/wp-content/uploads/sites/17/2020/05/002_ECOELCE.jpg"
            style="width: 350px; height: 250px; border-radius: 5px"
            alt="valores"
          />
        </div>
      </section>

      <section style="margin-top: 10px; border-radius: 15px;" id="contacto">
        <h2 style="margin-bottom: 0px;" class="titulos">Contáctanos</h2>
        <form
          novalidate
          class="form_contacto"
          onsubmit="return validarFormContacto()"
        >
          <div style="margin-top: 0px;" class="campo-nombre">
            <label for="nombre">Nombres:</label><br />
            <input
              type="text"
              id="nombre"
              name="nombre"
              placeholder="Ingresa tu nombre"
            />
          </div>

          <div class="campo-apellido">
            <label for="apellidos">Apellidos:</label><br />
            <input
              type="text"
              id="apellidos"
              name="apellidos"
              placeholder="Ingresa tu apellido"
            />
          </div>

          <div class="campo-correo">
            <label for="correo">Correo:</label><br />
            <input
              type="email"
              id="correo"
              name="correo"
              placeholder="Ingresa tu correo"
            />
          </div>

          <div class="campo-asunto">
            <label for="asunto">Asunto:</label><br />
            <textarea
              id="asunto"
              name="asunto"
              placeholder="Escribe el asunto"
            ></textarea>
          </div>

          <div class="button-enviar">
            <button class="boton-pequenio">Enviar</button>
          </div>
        </form>
      </section>
      <script>
        let arrIntegrantes = document.querySelectorAll(".tarjeta");
        arrIntegrantes.forEach((integrante) => {
          integrante.addEventListener("mouseover", cambiarEstiloInfo);
          integrante.addEventListener("mouseleave", cambiarEstiloInfo);
        });

        function cambiarEstiloInfo(evento) {
          let tarjeta = evento.currentTarget;
          let imgIntegrante = tarjeta.querySelector("img");
          let infoIntegrante = tarjeta.querySelector(".infoIntegrante");
          if (evento.type === "mouseover") {
            imgIntegrante.style.display = "none";
            infoIntegrante.style.display = "block";
            infoIntegrante.style.padding = "10px";
            infoIntegrante.style.fontSize = "0.9rem";
          } else if (evento.type === "mouseleave") {
            imgIntegrante.style.display = "block";
            infoIntegrante.style.display = "none";
          }
        }

        arrUrlsImagenes = [
          "https://blogs.iadb.org/ciudades-sostenibles/wp-content/uploads/sites/17/2020/05/002_ECOELCE.jpg",
          "https://www.rededuca.net/sites/default/files/2023-08/Dise%C3%B1o%20sin%20t%C3%ADtulo%20%2815%29.jpg",
          "https://d2k7w3fmrpj0w4.cloudfront.net/advices/photos/000/000/837/medium/38bfa332a8c1be5fd2cfff58f70f6c7e09bc4a7c.webp?1704485576"
        ];

        let indice = 0;
        function cambiarImagen() {
          indice++;
          if (indice >= arrUrlsImagenes.length) {
            indice = 0;
          }
          let imagenValores = document.querySelector("#listaValores img");
          imagenValores.src = arrUrlsImagenes[indice];
        }
        setInterval(cambiarImagen, 1500);

        //Validando form de contacto
        function validarFormContacto() {
          eliminarMensajes();
          let esValido = true;
          let validarCaracteres = /^[a-zA-Z\s]+$/;

          let nombre = document.getElementById("nombre");
          if (nombre.value === "") {
            cargarMensaje("*El nombre no puede estar vacío", nombre);
            esValido = false;
          } else if (nombre.value.length < 5) {
            cargarMensaje("*El nombre debe tener minimo 5 caracteres", nombre);
            esValido = false;
          } else if (!validarCaracteres.test(nombre.value)) {
            cargarMensaje("*El nombre solo puede tener letras", nombre);
            esValido = false;
          }

          let apellido = document.getElementById("apellidos");
          if (apellido.value === "") {
            cargarMensaje("*El apellido no puede estar vacío", apellido);
            esValido = false;
          } else if (apellido.value.length < 5) {
            cargarMensaje(
              "*El apellido debe tener minimo 5 caracteres",
              apellido
            );
            esValido = false;
          } else if (!validarCaracteres.test(apellido.value)) {
            cargarMensaje("*El apellido solo puede tener letras", apellido);
            esValido = false;
          }

          let correo = document.querySelector('input[name="correo"]');
          let correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (correo.value === "") {
            cargarMensaje("*El correo electrónico es requerido", correo);
            esValido = false;
          } else if (!correoRegex.test(correo.value)) {
            cargarMensaje("*El correo electrónico no es válido", correo);
            esValido = false;
          }

          let asunto = document.querySelector('textarea[name="asunto"]');
          if (asunto.value === "") {
            cargarMensaje("*El asunto no puede estar vacío", asunto);
            esValido = false;
          } else if (asunto.value.length < 15) {
            cargarMensaje("*El asunto debe tener mínimo 15 caracteres", asunto);
            esValido = false;
          }
          return esValido;
        }

        function cargarMensaje(mensajeError, elemento) {
          elemento.focus();
          let span = document.createElement("span");
          span.textContent = mensajeError;
          span.classList.add("error");
          elemento.parentNode.appendChild(span);
        }

        function eliminarMensajes() {
          let arrSpan = document.querySelectorAll(".error");
          arrSpan.forEach((span) => {
            span.remove();
          });
        }
      </script>
    </main>
<?php require_once FOOTER; ?>

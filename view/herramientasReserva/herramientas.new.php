<?php require_once HEADER; ?>

<div class="cabecera-reserva">
    <a href="index.php?c=herramienta&f=index_Reserva" style="padding: 0px; margin-left: 10px">
        <span class="material-symbols-outlined"> arrow_back_ios_new </span>
    </a>
    <h1 class="titulos" style="padding: 0px 10px">
        Reservación de Herramienta
    </h1>
</div>
<main>
    <section class="contenedor-form">
        <form method="get" id="formulario-herramienta" onsubmit="return validarFormulario()">
            <input type="hidden" name="id" id="id" value="<?php echo $herramienta['idHerramienta'] ?>" />
            <h3 class="subtitulos">Reservacion</h3>

            <fieldset>
                <h3 class="subtitulos">Información personal</h3>
                <label for="nombre">Nombre</label>
                <input class="inp" type="text" placeholder="Ingrese su nombre"
                id="nombre" name="nombre" />
                <span id="nombre-error" class="err"></span>

                <label for="telefono">Teléfono</label>
                <input type="tel" class="input" placeholder="Ingrese su número teléfono"
                id="telefono" name="telefono" maxlength="10" />
                <span id="telefono-error" class="err"></span>
            </fieldset>

            <fieldset>
              <label for="personas">Cantidad</label>
                  <input class="input" type="number" min="2" placeholder="Cantidad"
                      id="personas" name="personas" />
                  <span id="personas-error" class="err"></span>

                <h3 class="subtitulos">Detalle de la reserva</h3>
                <label for="fecha-desde">Desde</label>
                <input class="input" type="date" id="fecha-desde" name="fecha-desde" />
                <span id="fechaD-error" class="err"></span>

                <label for="fecha-hasta">Hasta</label>
                <input class="input" type="date" id="fecha-hasta" name="fecha-hasta" />
                <span id="fechaH-error" class="err"></span>

                <label for="notas">Proposito de uso</label>
                <textarea id="uso"name="uso"
                    placeholder="Agregue proposito de la herramienta"></textarea>
                <span id="notas-error" class="err"></span>
            </fieldset>

            <fieldset class="contenedor-botones">
                <button type="reset" class="boton-mediano cancelar">
                    Cancelar
                </button>
                <button type="submit" class="boton-mediano" id="btn">
                    Reservar
                </button>
            </fieldset>
        </form>
    </section>
    <section class="contenedor-informacion">

        <h3 class="subtitulos nombre-instalacion"><?php echo $herramienta['nombre'] ?></h3>
   
        <img src="" alt="Imagen" id="imagen-instalacion"
            style="object-fit: cover;border-radius: 8px;width: 100%;height: 300px;">
        <div class="informacion-extra" style="display: flex;flex-direction: column;gap: 10px;margin-top: 10px;">
            <hr class="linea-divisoria" />
            <div>
                <p class="texto">Precio de reserva:</p>
                <span class="texto precio-instalacion"><?php echo $herramienta['precio'] ?></span>
            </div>
        </div>
    </section>
</main>

<?php require_once FOOTER; ?>
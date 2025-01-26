<?php require_once HEADER; ?>

<div class="cabecera-reserva">
    <a href="index.php?c=instalacion&f=index" style="padding: 0px; margin-left: 10px">
        <span class="material-symbols-outlined"> arrow_back_ios_new </span>
    </a>
    <h1 style="padding: 0px 10px; font-size: 1.5rem;">
        Reservación de la Instalación
    </h1>
</div>
<main>
    <section class="contenedor-formulario">
        <form
            action="index.php?c=instalacion&f=reservarInstalacion"
            method="post"
            id="formulario-instalaciones"
            onsubmit="return validarFormulario()">
            <input type="hidden" name="id" id="id" value="<?php echo $instalacion['idInstalacion'] ?>" />
            <h3 class="subtitulos">Formulario de reservación</h3>

            <fieldset>
                <h3 class="subtitulos">Información personal</h3>
                <label for="nombre">Nombre completo</label>
                <input
                    class="input"
                    type="text"
                    placeholder="Ingrese su nombre"
                    id="nombre"
                    name="nombre" />
                <span id="nombre-error" class="error"></span>

                <label for="telefono">Teléfono</label>
                <input
                    type="tel"
                    class="input"
                    placeholder="Ingrese su número teléfono"
                    id="telefono"
                    name="telefono"
                    maxlength="10" />
                <span id="telefono-error" class="error"></span>

                <label>¿Es un miembro de la comunidad?</label>
                <div class="radio-grupo">
                    <div style="display: flex; align-items: center">
                        <input
                            style="width: auto; margin: 0px 10px"
                            type="radio"
                            id="miembro-si"
                            name="miembro"
                            value="si" />
                        <label for="miembro-si">Sí</label>
                    </div>
                    <div style="display: flex; align-items: center">
                        <input
                            style="width: auto; margin: 0px 10px"
                            type="radio"
                            id="miembro-no"
                            name="miembro"
                            value="no" />
                        <label for="miembro-no">No</label>
                    </div>
                </div>
                <span id="miembro-error" class="error"></span>
            </fieldset>

            <fieldset>
                <h3 class="subtitulos">Fecha de la reserva</h3>
                <label for="fecha-desde">Desde</label>
                <input class="input" type="date" id="fecha-desde" name="fechaInicio" />
                <span id="fechaD-error" class="error"></span>

                <label for="fecha-hasta">Hasta</label>
                <input class="input" type="date" id="fecha-hasta" name="fechaFin" />
                <span id="fechaH-error" class="error"></span>
            </fieldset>

            <fieldset>
                <h3 class="subtitulos">Información de la reserva</h3>
                <div>
                    <label for="personas">Personas esperadas</label>
                    <input
                        class="input"
                        type="number"
                        min="2"
                        placeholder="Cantidad de personas"
                        id="personasEsperadas"
                        name="personasEsperadas" />
                    <span id="personas-error" class="error"></span>

                    <label for="proposito">Proposito de la reserva</label>
                    <select class="input-selected" name="proposito" id="proposito" class="propositos">
                        <option value="">Seleccionar...</option>
                        <option value="evento">Evento</option>
                        <option value="reunion">Reunión</option>
                        <option value="conferencia">Conferencia</option>
                        <option value="otro">Otro</option>
                    </select>
                    <span id="proposito-error" class="error"></span>
                </div>

                <label for="notas">Datos adicionales (opcional)</label>
                <textarea
                    id="observaciones"
                    name="observaciones"
                    placeholder="Agregue información adicional (opcional)"></textarea>
                <span id="notas-error" class="error"></span>
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

        <h3 class="subtitulos nombre-instalacion"><?php echo $instalacion['nombre'] ?></h3>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($instalacion['imagen']); ?>" alt="Imagen" id="imagen-instalacion"
            style="
            object-fit: cover;
            border-radius: 8px;
            width: 100%;
            height: 300px;
          ">
        <div
            class="informacion-extra"
            style="
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 10px;
          ">
            <div>
                <p class="texto">Tamaño:</p>
                <span class="texto tamanio-instalacion"><?php echo $instalacion['tamano'] ?></span>
            </div>
            <div>
                <p class="texto">Tipo:</p>
                <span class="texto tipo-instalacion"><?php echo $instalacion['tipo_nombre'] ?></span>
            </div>
            <hr class="linea-divisoria" />
            <div>
                <p class="texto">Precio de reserva:</p>
                <span class="texto precio-instalacion"><?php echo $instalacion['precio'] ?></span>
            </div>
        </div>
    </section>
</main>

<?php require_once FOOTER; ?>
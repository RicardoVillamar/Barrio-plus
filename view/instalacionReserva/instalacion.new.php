<?php require_once HEADER; ?>

<div class="cabecera-reserva">
    <a href="instalaciones.html" style="padding: 0px; margin-left: 10px">
        <span class="material-symbols-outlined"> arrow_back_ios_new </span>
    </a>
    <h1 class="titulos" style="padding: 0px 10px">
        Reservación de la Instalación
    </h1>
</div>
<main>
    <section class="contenedor-formulario">
        <form
            id="formulario-instalaciones"
            onsubmit="return validarFormulario()">
            <h3 class="subtitulos">Formulario de reservación</h3>
            <fieldset>
                <h3 class="subtitulos">Información personal</h3>
                <label for="nombre">Nombre completo</label>
                <input
                    type="text"
                    placeholder="Ingrese su nombre"
                    id="nombre"
                    name="nombre" />
                <span id="nombre-error" class="error"></span>

                <label for="telefono">Teléfono</label>
                <input
                    type="tel"
                    placeholder="Ingrese su número teléfono"
                    id="telefono"
                    name="telefono"
                    maxlength="10" />
                <span id="telefono-error" class="error"></span>

                <label>¿Es un miembro de la comunidad?</label>
                <div class="radio-grupo">
                    <div style="display: flex; margin-right: 10px">
                        <input
                            style="width: auto; height: auto; margin: 0px 10px"
                            type="radio"
                            id="miembro-si"
                            name="miembro"
                            value="si" />
                        <label for="miembro-si">Sí</label>
                    </div>
                    <div style="display: flex; margin-left: 10px">
                        <input
                            style="width: auto; height: auto; margin: 0px 10px"
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
                <input type="date" id="fecha-desde" name="fecha-desde" />
                <span id="fechaD-error" class="error"></span>

                <label for="fecha-hasta">Hasta</label>
                <input type="date" id="fecha-hasta" name="fecha-hasta" />
                <span id="fechaH-error" class="error"></span>
            </fieldset>

            <fieldset>
                <h3 class="subtitulos">Información de la reserva</h3>
                <div>
                    <label for="personas">Personas esperadas</label>
                    <input
                        type="number"
                        min="2"
                        placeholder="Cantidad de personas"
                        id="personas"
                        name="personas" />
                    <span id="personas-error" class="error"></span>

                    <label for="proposito">Proposito de la reserva</label>
                    <select name="proposito" id="proposito" class="propositos">
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
                    id="notas"
                    name="notas"
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
        <h3 class="subtitulos nombre-instalacion">Salon comunal</h3>
        <img
            id="imagen-instalacion"
            src="../../assets/img/instalaciones/salon-comunal.png"
            alt="instalaciones"
            style="
            object-fit: cover;
            border-radius: 8px;
            width: 100%;
            height: 300px;
          " />
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
                <span class="texto tamanio-instalacion">Grande</span>
            </div>
            <div>
                <p class="texto">Tipo:</p>
                <span class="texto tipo-instalacion">Salon</span>
            </div>
            <hr class="linea-divisoria" />
            <div>
                <p class="texto">Precio de reserva:</p>
                <span class="texto precio-instalacion">$15.00</span>
            </div>
        </div>
    </section>
</main>

<?php require_once FOOTER; ?>
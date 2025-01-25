<?php require_once HEADER; 
//Autor: Quiñonez Castrellón Anthony Joel
?>

<div style="display: flex; align-items: center;">
    <a href="index.php?c=herramienta&f=index_Herramienta" style="padding: 0px; margin-left: 10px">
        <span class="material-symbols-outlined"> arrow_back_ios_new </span>
    </a>
    <h3 style="margin-left: 10px;">Reserva de Herramientas</h3>
</div>
<main>
<section class="contenedor-formulario">
        <form action="index.php?c=herramienta&f=reservarHerramienta" method="POST" id="formulario-herramienta" onsubmit="return validarFormulario()">
            <input type="hidden" name="idHerramienta" value="<?php echo $herramienta['idHerramienta']; ?>" />
            <input type="hidden" name="nombreHerramienta" value="<?php echo $herramienta['nombre']; ?>" />
            <input type="hidden" name="precioHerramienta" value="<?php echo $herramienta['precio']; ?>" />
            <input type="hidden" name="imagenHerramienta" value="<?php echo base64_encode($herramienta['imagen']); ?>" />

            <h3 class="subtitulos">Reservacion</h3>

            <fieldset>
                <h3 class="subtitulos">Información personal</h3>
                <label for="nombre">Nombre</label>
                <input class="input" type="text" placeholder="Ingrese su nombre" id="nombre" name="nombre" /> 
                <span id="nombre-error" class="error"></span>

                <label for="cantidad">Cantidad</label>
                <input class="input" type="number" min="1" placeholder="Cantidad de herramientas" id="cantidad" name="cantidad" />
                <span id="personas-error" class="error"></span>
            </fieldset>

            <fieldset>
                <h3 class="subtitulos">Detalles de la reserva</h3>
                <label for="fechaInicio">Desde</label>
                <input class="input" type="date" id="fechaInicio" name="fechaInicio" />
                <span id="fechaD-error" class="error"></span>

                <label for="fechaFin">Hasta</label>
                <input class="input" type="date" id="fechaFin" name="fechaFin" />
                <span id="fechaH-error" class="error"></span>

                <label for="proposito">Propósito de uso</label>
                <textarea id="proposito" name="proposito" placeholder="Ingrese el propósito de uso de la herramienta"></textarea>

                <div class="check">
                    <input class="capaci" type="checkbox" name="capacita" value="1"/>
                    <label> ¿Requiere capacitación para usar la herramienta?</label>
                </div>
            </fieldset>
            <fieldset class="contenedor-botones">
                <button type="reset" class="boton-mediano cancelar">Cancelar</button>
                <button type="submit" class="boton-mediano" id="btn">Reservar</button>
            </fieldset>
        </section>
        <section class="contenedor-informacion">
    
            <h3 class="subtitulos nombre-instalacion"><?php echo $herramienta['nombre'] ?></h3>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($herramienta['imagen']); ?>" alt="Imagen" id="imagen-herramienta"
                style="object-fit: cover; border-radius: 8px; width: 100%;height: 300px;">
            <div class="informacion-extra" style="display: flex;flex-direction: column;gap: 10px; margin-top: 10px;">
                <hr class="linea-divisoria" />
                <div>
                    <p class="texto">Precio de reserva:</p>
                    <span class="texto precio-instalacion"><?php echo $herramienta['precio'] ?></span>
                </div>
            </div>
        </section>
    </form>
</main>

<?php require_once FOOTER; ?>

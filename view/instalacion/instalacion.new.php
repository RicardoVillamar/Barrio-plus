<?php
//Autor: Villamar Minuche Ricardo Daniel
require_once HEADER
?>

<main style="display: flex; justify-content: center; align-items: center;">
    <section class="contenedor-formulario">

        <form action="index.php?c=instalacion&f=insert" method="POST" enctype="multipart/form-data" id="formulario-instalaciones" style="display: flex; flex-direction: column; gap: 10px;">
            <div style="display: flex; align-items: center;">
                <a href="index.php?c=instalacion&f=index_instalacion" style="padding: 0px; margin-left: 10px">
                    <span class="material-symbols-outlined"> arrow_back_ios_new </span>
                </a>
                <h3 style="margin-left: 10px;">Registro de instalacion</h3>
            </div>

            <div>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="input" placeholder="Nombre de la instalacion">
            </div>

            <div>
                <label for="descripcion">Descripcion</label>
                <textarea id="descripcion" name="descripcion" placeholder="Descripcion de la instalacion"></textarea>
            </div>

            <div>
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" class="input" placeholder="Precio de la instalacion">
            </div>

            <div>
                <label for="tamano">Tamaño</label>
                <input type="text" id="tamano" name="tamano" class="input" placeholder="Tamaño de la instalacion">
            </div>

            <div>
                <label for="tipo">Tipo</label>
                <select id="tipo" name="tipo" class="input-selected">
                    <?php
                    foreach ($tipos as $fila) {
                    ?>
                        <option value="<?php echo $fila['idTipo']; ?>"><?php echo $fila['nombre']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="estado">Estado</label>
                <select id="estado" name="estado" class="input-selected">
                    <?php
                    foreach ($estados as $fila) {
                    ?>
                        <option value="<?php echo $fila['idEstado']; ?>"><?php echo $fila['nombre']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="contribuidor">Contribuidor</label>
                <input type="text" id="contribuidor" name="contribuidor" class="input" placeholder="contribuidor de la instalacion">
            </div>

            <div>
                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" class="input">
            </div>

            <div style="display: flex; justify-content: space-between;">
                <button type="reset" class="boton-mediano cancelar">Cancelar</button>
                <button type="submit" class="boton-mediano">Registrar</button>
            </div>
        </form>
    </section>
</main>


<?php require_once FOOTER ?>
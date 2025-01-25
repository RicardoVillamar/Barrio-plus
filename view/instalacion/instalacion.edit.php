<?php
//Autor: Villamar Minuche Ricardo Daniel
require_once HEADER
?>

<main style="display: flex; justify-content: center; align-items: center;">
    <section class="contenedor-formulario">

        <form action="index.php?c=instalacion&f=edit" method="POST" enctype="multipart/form-data" id="formulario-instalaciones" style="display: flex; flex-direction: column; gap: 10px;">
            <input type="hidden" name="id" value="<?php echo $instalacion['idInstalacion']; ?>">
            <div style="display: flex; align-items: center;">
                <a href="index.php?c=instalacion&f=index_instalacion" style="padding: 0px; margin-left: 10px">
                    <span class="material-symbols-outlined"> arrow_back_ios_new </span>
                </a>
                <h3 style="margin-left: 10px;">Editar instalacion</h3>
            </div>

            <div>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="input" placeholder="Nombre de la instalacion" value="<?php echo $instalacion['nombre']; ?>">
            </div>

            <div>
                <label for="descripcion">Descripcion</label>
                <textarea id="descripcion" name="descripcion" placeholder="<?php echo $instalacion['descripcion']; ?>"></textarea>
            </div>

            <div>
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" class="input" value="<?php echo $instalacion['precio'] ?>" placeholder="Precio de la instalacion">
            </div>

            <div>
                <label for="tamano">Tamaño</label>
                <input type="text" id="tamano" name="tamano" class="input" placeholder="Tamaño de la instalacion" value="<?php echo $instalacion['tamano'] ?>">
            </div>

            <div>
                <label for="tipo">Tipo</label>
                <select id="tipo" name="tipo" class="input-selected">
                    <?php
                    foreach ($tipos as $tip) {
                        $selected = ($tip['nombre'] == $instalacion['tipo_nombre']) ? 'selected' : '';
                    ?>
                        <option <?php echo $selected ?> value="<?php echo $tip['nombre'] ?>"><?php echo $tip['nombre'] ?></option>
                    <?php
                    }
                    ?>
                </select>

            </div>

            <div>
                <label for="estado">Estado</label>
                <select id="estado" name="estado" class="input-selected">
                    <?php
                    foreach ($estados as $estado) {
                        $selected = ($estado['nombre'] == $instalacion['estado_nombre']) ? 'selected' : '';
                        echo "<option value='{$estado['nombre']}' {$selected}>{$estado['nombre']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="contribuidor">Contribuidor</label>
                <input type="text" id="contribuidor" name="contribuidor" class="input" placeholder="contribuidor de la instalacion" value="<?php echo $instalacion['contribuidor_nombre'] ?>">
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
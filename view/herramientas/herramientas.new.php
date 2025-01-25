<!-- autor: Quiñonez Castrellón Anthony Joel -->

<?php require_once HEADER; ?>

<main class="contenedor-formulario">
    <section>
        <form action="index.php?c=herramienta&f=insert" method="POST" id="form-herramienta" style="display: flex; flex-direction: column; gap: 10px;">
            <div style="display: flex; align-items: center;">
                <a href="index.php?c=herramienta&f=index" style="padding: 0px; margin-left: 10px">
                    <span class="material-symbols-outlined"> arrow_back_ios_new </span>
                </a>
                <h3 style="margin-left: 10px;">Registro de Herramienta</h3>
            </div>
            
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="input" placeholder="Nombre de la instalacion">
            </div>

            <div>
                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" class="input">
            </div>
            
            <div>
                <label for="descripcion">Descripción:</label><br>
                <textarea id="descripcion"name="descripcion" placeholder="Descripción de la herramienta" rows="5"></textarea>
            </div>

            <div>
                <label for="precio">Precio</label>
                <input type="number" step="0.01" name="precio" id="precio" class="input" placeholder="Precio de la herramienta">
            </div>

            <div>
            <label for="fechaRegistro">Fecha de Registro</label>
            <input type="date" name="fechaRegistro" id="fechaRegistro" class="input" required>
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
                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="input" placeholder="Cantidad disponible">
            </div>

            <div>
                <label for="contribuidor">Contribuidor:</label>
                <input type="text" name="contribuidor" id="contribuidor" placeholder="Nombre del contribuidor" class="input">
            </div>

            <div>
                <label for="mantenimiento">Mantenimiento</label>
                <input type="number" name="mantenimiento" id="cantidad" class="input" placeholder="Cantidad de mantenimiento">

            </div>
            <div style="text-align: center;">
                <button type="submit" class="boton-mediano">Registrar</button>
            </div>

        </form>
    </section>
</main>
<?php require_once FOOTER; ?>

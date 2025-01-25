<!--Autor: Quiñonez Castrellón Anthony Joel-->
<?php require_once HEADER ?>

<main style="display: flex; justify-content: center; align-items: center;">
    <section class="contenedor-formulario">

        <form action="index.php?c=herramienta&f=insert" method="POST" enctype="multipart/form-data" id="formulario-herramienta" style="display: flex; flex-direction: column; gap: 10px;">
            <div style="display: flex; align-items: center;">
                <a href="index.php?c=herramienta&f=index" style="padding: 0px; margin-left: 10px">
                    <span class="material-symbols-outlined"> arrow_back_ios_new </span>
                </a>
                <h3 style="margin-left: 10px;">Registro de instalacion</h3>
            </div>

            <div>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="input" placeholder="Nombre de la Herramienta">
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
                <label for="mantenimiento">Mantenimiento</label>
                <textarea id="mantenimiento"name="mantenimiento" placeholder="Descripción de los mantenimientos utilizados" rows="5"></textarea>

            </div>

            <div>
                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="input" placeholder="Cantidad disponible">
            </div>


            <div style="display: flex; justify-content: space-between;">
                <button type="reset" class="boton-mediano cancelar">Cancelar</button>
                <button type="submit" class="boton-mediano">Registrar</button>
            </div>
        </form>
    </section>
</main>


<?php require_once FOOTER ?>

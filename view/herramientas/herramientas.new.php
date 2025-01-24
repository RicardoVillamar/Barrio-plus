<!-- autor: Quiñonez Castrellón Anthony Joel -->

<?php require_once HEADER; ?>
<link rel="stylesheet" href="assets/css/herramientasReStyle.css" />


<main class="contenedor-formulario">
    <section>
        <form action="index.php?c=herramienta&f=new" method="POST" id="form-herramienta" style="display: flex; flex-direction: column; gap: 10px;">
            <div style="display: flex; align-items: center;">
                <a href="index.php?c=herramienta&f=index" style="padding: 0px; margin-left: 10px">
                    <span class="material-symbols-outlined"> arrow_back_ios_new </span>
                </a>
                <h3 style="margin-left: 10px;">Registro de Herramienta</h3>
            </div>
            
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="input" placeholder="Nombre de la instalacion"
                value="<?= htmlspecialchars($_POST['nombre'] ?? '')?>">
            </div>

            <div>
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" id="imagen" class="input" value="<?= htmlspecialchars($_FILES['imagen'] ?? '')?>">
            </div>
            
            <div>
                <label for="descripcion">Descripción:</label><br>
                <textarea id="descripcion"name="descripcion" placeholder="Descripción de la herramienta" rows="5"
                value="<?= htmlspecialchars($_POST['descripcion'] ?? '')?>"></textarea>
            </div>

            <div>
                <label for="precio">Precio</label>
                <input type="number" step="0.01" name="precio" id="precio" class="input" placeholder="Precio de la herramienta"
                value="<?= htmlspecialchars($_POST['precio'] ?? '')?>">
            </div>

            <div>
            <label for="fechaRegistro">Fecha de Registro</label>
            <input type="date" name="fechaRegistro" id="fechaRegistro" class="input" 
            value="<?= htmlspecialchars($_POST['fechaRegistro'] ?? '')?>"required>
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
                <input type="number" name="cantidad" id="cantidad" class="input" placeholder="Cantidad disponible"
                value="<?= htmlspecialchars($_POST['cantidad'] ?? '')?>">
            </div>

            <div>
                <label for="contribuidor">Contribuidor</label>
                <input type="text" id="nombre" name="nombre" class="input" placeholder="Nombre de la instalacion">
            </div> 

            <div>
                <input type="checkbox" id="mantenimiento" name="mantenimiento"
                <?php echo (isset($_POST['mantenimiento']) && $_POST['mantenimiento'] == 'on') ? 'checked="checked"' : ''; ?>>
                <label for="mantenimiento">Requiere Mantenimiento</label>
            </div>
            <div>
                <button type="submit" class="boton-mediano">Registrar</button>
            </div>

        </form>
    </section>
</main>

<!-- en el contribuidor es para que ingreses tu nombre de contribuidor pero saldra como identificador en la tabla -->

<?php require_once FOOTER; ?>

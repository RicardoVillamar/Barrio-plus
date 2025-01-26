<!--Autor: Quiñonez Castrellón Anthony Joel-->
<?php require_once HEADER?>

<main style="display: flex; justify-content: center; align-items: center;">
    <section class="contenedor-formulario">

        <form action="index.php?c=herramienta&f=edit" method="POST" enctype="multipart/form-data" id="formulario-herramienta" style="display: flex; flex-direction: column; gap: 10px;">
            <input type="hidden" name="id" value="<?php echo $herramienta['idHerramienta']; ?>">
            <div style="display: flex; align-items: center;">
                <a href="index.php?c=herramienta&f=index" style="padding: 0px; margin-left: 10px">
                    <span class="material-symbols-outlined"> arrow_back_ios_new </span>
                </a>
                <h3 style="margin-left: 10px;">Editar instalacion</h3>
            </div>

            <div>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" class="input" placeholder="Nombre de la herramienta" value="<?= htmlspecialchars($herramienta['nombre'] ?? '') ?>">
        <?php if (isset($errores['nombre'])): ?>
            <span class="error"><?php echo $errores['nombre']; ?></span>
        <?php endif; ?>
    </div>

    <!-- Imagen -->
    <div>
        <label for="imagen">Imagen</label>
        <input type="file" id="imagen" name="imagen" accept="image/*" class="input">
        <?php if (!empty($herramienta['imagen'])): ?>
            <img src="data:image/jpeg;base64,<?= base64_encode($herramienta['imagen']) ?>" alt="Imagen de la herramienta" style="max-width: 150px; margin-top: 10px;">
        <?php endif; ?>
        <?php if (isset($errores['imagen'])): ?>
            <span class="error"><?php echo $errores['imagen']; ?></span>
        <?php endif; ?>
    </div>

    <!-- Descripción -->
    <div>
        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" placeholder="Descripción de la herramienta" rows="5"><?= htmlspecialchars($herramienta['descripcion'] ?? '') ?></textarea>
        <?php if (isset($errores['descripcion'])): ?>
            <span class="error"><?php echo $errores['descripcion']; ?></span>
        <?php endif; ?>
    </div>

    <!-- Precio -->
    <div>
        <label for="precio">Precio</label>
        <input type="number" step="0.01" name="precio" id="precio" class="input" placeholder="Precio de la herramienta" value="<?= htmlspecialchars($herramienta['precio'] ?? '') ?>">
        <?php if (isset($errores['precio'])): ?>
            <span class="error"><?php echo $errores['precio']; ?></span>
        <?php endif; ?>
    </div>

    <!-- Fecha de Registro -->
    <div>
        <label for="fechaRegistro">Fecha de Registro</label>
        <input type="date" name="fechaRegistro" id="fechaRegistro" class="input" value="<?= htmlspecialchars($herramienta['fechaRegistro'] ?? '') ?>" required>
        <?php if (isset($errores['fechaRegistro'])): ?>
            <span class="error"><?php echo $errores['fechaRegistro']; ?></span>
        <?php endif; ?>
    </div>

    <!-- Estado -->
    <div>
        <label for="estado">Estado</label>
        <select id="estado" name="estado" class="input-selected">
            <?php foreach ($estados as $fila): ?>
                <option value="<?= $fila['idEstado'] ?>" <?= ($fila['idEstado'] == ($herramienta['idEstadoFK'] ?? '')) ? 'selected' : '' ?>>
                    <?= $fila['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errores['estado'])): ?>
            <span class="error"><?php echo $errores['estado']; ?></span>
        <?php endif; ?>
    </div>

    <!-- Mantenimiento -->
    <div>
        <label for="mantenimiento">Mantenimiento</label>
        <textarea id="mantenimiento" name="mantenimiento" placeholder="Descripción de los mantenimientos hechos" rows="5"><?= htmlspecialchars($herramienta['mantenimiento'] ?? '') ?></textarea>
        <?php if (isset($errores['mantenimiento'])): ?>
            <span class="error"><?php echo $errores['mantenimiento']; ?></span>
        <?php endif; ?>
    </div>

    <!-- Cantidad -->
    <div>
        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" class="input" placeholder="Cantidad disponible" value="<?= htmlspecialchars($herramienta['cantidad'] ?? '') ?>">
        <?php if (isset($errores['cantidad'])): ?>
            <span class="error"><?php echo $errores['cantidad']; ?></span>
        <?php endif; ?>
    </div>

    <!-- Botones -->
    <div style="display: flex; justify-content: space-between;">
        <button type="reset" class="boton-mediano cancelar" onclick="window.location.href='index.php?c=herramienta&f=index'">Cancelar</button>
        <button type="submit" class="boton-mediano">Actualizar</button>
    </div>
</form>
    </section>
</main>

<?php require_once FOOTER ?>

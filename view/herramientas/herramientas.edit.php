<?php
//Autor: Quiñonez Castrellón Anthony Joel
require_once HEADER
?>

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
            </div>

            <div>
                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" class="input">
                <?php if (!empty($herramienta['imagen'])): ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($herramienta['imagen']) ?>" alt="Imagen de la herramienta" style="max-width: 150px; margin-top: 10px;">
                <?php endif; ?>
            </div>

            <div>
                <label for="descripcion">Descripción:</label><br>
                <textarea id="descripcion" name="descripcion" placeholder="Descripción de la herramienta" rows="5"><?= htmlspecialchars($herramienta['descripcion'] ?? '') ?></textarea>
            </div>

            <div>
                <label for="precio">Precio</label>
                <input type="number" step="0.01" name="precio" id="precio" class="input" placeholder="Precio de la herramienta" value="<?= htmlspecialchars($herramienta['precio'] ?? '') ?>">
            </div>

            <div>
                <label for="fechaRegistro">Fecha de Registro</label>
                <input type="date" name="fechaRegistro" id="fechaRegistro" class="input" value="<?= htmlspecialchars($herramienta['fechaRegistro'] ?? '') ?>" required>
            </div>

            <div>
                <label for="estado">Estado</label>
                <select id="estado" name="estado" class="input-selected">
                    <?php foreach ($estados as $fila): ?>
                        <option value="<?= $fila['idEstado'] ?>" <?= ($fila['idEstado'] == ($herramienta['idEstadoFK'] ?? '')) ? 'selected' : '' ?>>
                            <?= $fila['nombre'] ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <div>
                <label for="mantenimiento">Mantenimiento</label>
                <textarea id="mantenimiento" name="mantenimiento" placeholder="Descripción de los mantenimientos hechos" rows="5"><?= htmlspecialchars($herramienta['mantenimiento'] ?? '') ?></textarea>
            </div>
            
            <div>
                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="input" placeholder="Cantidad disponible" value="<?= htmlspecialchars($herramienta['cantidad'] ?? '') ?>">
            </div>

            <div style="display: flex; justify-content: space-between;">
                <button type="reset" class="boton-mediano cancelar" onclick="window.location.href='index.php?c=herramienta&f=index'">Cancelar</button>
                <button type="submit" class="boton-mediano">Registrar</button>
            </div>
        </form>
    </section>
</main>

<?php require_once FOOTER ?>

<!-- Autor: Quiñonez Castrellón Anthony Joel -->
<?php require_once HEADER ?>

<main style="display: flex; justify-content: center; align-items: center;">
    <section class="contenedor-formulario">
        <form action="index.php?c=herramienta&f=insert" method="POST" enctype="multipart/form-data" 
        id="formulario-herramienta" style="display: flex; flex-direction: column; gap: 10px;">
        <div style="display: flex; align-items: center;">
            <a href="index.php?c=herramienta&f=index" style="padding: 0px; margin-left: 10px">
                <span class="material-symbols-outlined"> arrow_back_ios_new </span></a>
                <h3 style="margin-left: 10px;">Registro de Herramientas</h3>
        </div>
        
        <div>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="input" placeholder="Nombre de la Herramienta" value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>">
            <?php if (!empty($errores['nombre'])): ?>
                <p class="error"><?= $errores['nombre'] ?></p>
                <?php endif; ?>
        </div>
        
        <div>
            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" class="input">
            <?php if (!empty($errores['imagen'])): ?>
                <p class="error"><?= $errores['imagen'] ?></p>
                <?php endif; ?>
        </div>
        
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" placeholder="Descripción de la herramienta" rows="5"><?= htmlspecialchars($_POST['descripcion'] ?? '') ?></textarea>
            <?php if (!empty($errores['descripcion'])): ?>
                <p class="error"><?= $errores['descripcion'] ?></p>
                <?php endif; ?>
        </div>
        
        <div>
            <label for="precio">Precio</label>
            <input type="number" step="0.01" name="precio" id="precio" class="input" placeholder="Precio de la herramienta" value="<?= htmlspecialchars($_POST['precio'] ?? '') ?>">
            <?php if (!empty($errores['precio'])): ?>
                <p class="error"><?= $errores['precio'] ?></p>
                <?php endif; ?>
        </div>
            
        <div>
            <label for="fechaRegistro">Fecha de Registro</label>
            <input type="date" name="fechaRegistro" id="fechaRegistro" class="input" value="<?= htmlspecialchars($_POST['fechaRegistro'] ?? '') ?>">
            <?php if (!empty($errores['fechaRegistro'])): ?>
                <p class="error"><?= $errores['fechaRegistro'] ?></p>
                <?php endif; ?>
        </div>
        
        <div style="display:none;">
            <label for="estado">Estado</label>
            <select id="estado" name="estado" class="input-selected">
                <?php foreach ($estados as $fila): ?>
                    <option value="<?= $fila['idEstado'] ?>" <?= isset($_POST['estado']) && $_POST['estado'] == $fila['idEstado'] ? 'selected' : '' ?>><?= $fila['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($errores['estado'])): ?>
                    <p class="error"><?= $errores['estado'] ?></p>
                    <?php endif; ?>
        </div>
        
        <div>
            <label for="mantenimiento">Mantenimiento</label>
            <textarea id="mantenimiento"name="mantenimiento" placeholder="Descripción de los mantenimientos utilizados" rows="5"><?= htmlspecialchars($_POST['mantenimiento'] ?? '') ?></textarea>
            <?php if (!empty($errores['mantenimiento'])): ?>
                <p class="error"><?= $errores['mantenimiento'] ?></p>
                <?php endif; ?>
        </div>
        
        <div>
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="input" placeholder="Ingrese cuantas herramientas quiere donar" value="<?= htmlspecialchars($_POST['cantidad'] ?? '') ?>">
            <?php if (!empty($errores['cantidad'])): ?>
                <p class="error"><?= $errores['cantidad'] ?></p>
                <?php endif; ?>
            </div>
        
        <div style="display: flex; justify-content: space-between;">
            <button type="reset" class="boton-mediano cancelar" onclick="window.location.href='index.php?c=herramienta&f=index'">Cancelar</button>
            <button type="submit" class="boton-mediano">Registrar</button>
        </div>
        </form>
    </section>
</main>


<?php require_once FOOTER ?>

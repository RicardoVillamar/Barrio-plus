<!--Autor:Palacios Herdoiza Roitman Andres-->
<?php require_once HEADER ?>
<main style="width: 100%; display: flex; flex-direction: column; align-items: center; gap: 20px;">

    <section class="contenedor-formulario div-editar">

        <h1>Editar información del usuario</h1>
        <form action="index.php?c=usuario&f=edit" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
            <input type="hidden" name="idUsuario" value="<?php echo htmlspecialchars($usuario['idUsuario']); ?>">
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>">
            </div>
            <div>
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($usuario['apellido']); ?>">
            </div>
            <div>
                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($usuario['correo']); ?>">
            </div>
            <div>
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" value="<?php echo htmlspecialchars($usuario['contrasena']); ?>">
            </div>
            <div>
                <label for="contribuidor">Desea ser Contribuidor:</label>
                <input type="checkbox" id="contribuidor" name="contribuidor" value="1">
            </div>
            <div style="display: flex; justify-content: center;">
                <button type="submit" class="boton-mediano">Guardar Cambios</button>
            </div>
        </form>
    </section>

</main>
<?php require_once FOOTER   ?>
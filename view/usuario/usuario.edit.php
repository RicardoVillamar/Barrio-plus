<!--Autor:Palacios Herdoiza Roitman Andres-->
<?php   require_once HEADER ?>

<section>

<h1>Editar Información del Usuario</h1>
    <form action="index.php?c=usuario&f=edit" method="POST">
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
        <button type="submit">Guardar Cambios</button>
    </form>
</section>

<?php   require_once FOOTER   ?>
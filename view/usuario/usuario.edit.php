<!--Autor:Palacios Herdoiza Roitman Andres-->
<?php   require_once HEADER ?>

<section>
<h1 class="titulos">Registro</h1>
<form action="index.php?c=usuarios&f=registrar" method="POST">
    <h2 class="subtitulos">Registro de Usuario</h2>
    
    <div>
        <label for="nombre">Nombres:</label><br>
        <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre" required>
    </div>

    <div>
        <label for="apellido">Apellidos:</label><br>
        <input type="text" id="apellido" name="apellido" placeholder="Ingrese sus apellidos" required>
    </div>

    <div>
        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" placeholder="Ingrese su correo" required>
    </div>

    <div>
        <label for="contrasena">Contraseña:</label><br>
        <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña" required>
    </div>

 

    <div>
        <button type="submit">Registrarse</button>
        <button type="reset">Cancelar</button>
    </div>
</form>
</section>

<?php   require_once FOOTER   ?>
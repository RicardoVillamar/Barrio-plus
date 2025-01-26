<!--Autor:Palacios Herdoiza Roitman Andres-->
<?php require_once HEADER ?>


<section>
<h1 class="titulos">Registro</h1>
<form action="index.php?c=usuario&f=new" method="POST" >
    
    <h2 class="subtitulos">Registro de Usuario</h2>
    
    <div>
        <label for="nombre">Nombres:</label><br>
        <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre" >
    </div>

    <div>
        <label for="apellido">Apellidos:</label><br>
        <input type="text" id="apellido" name="apellido" placeholder="Ingrese sus apellidos" >
    </div>


    <div>
        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="email" placeholder="Ingrese su correo" >
    </div>
    <div>
        <label for="imagen">Imagen de perfil:</label>
        <input type="file" name="imagen" id="imagen">
    </div>
    <div>
        <label for="contrasena">Contraseña:</label><br>
        <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña" >
    </div>

    <div>
        <label for="contribuidor">Desea ser Contribuidor:</label>
        <input type="checkbox" id="contribuidor" name="contribuidor" value="1">
    </div>

    <div>
        <button type="submit" name="accion" value="registrarse">Registrarse</button>
        <button type="reset">Cancelar</button>
    </div>
</form>
</section>
<?php require_once FOOTER ?>
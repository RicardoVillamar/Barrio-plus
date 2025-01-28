<!--Autor:Palacios Herdoiza Roitman Andres-->
<style>
    * {
        font-family: Verdana;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #f0f2f5;
    }

    .login-container {
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 300px;
    }

    input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #a8d0e6;
        color: #4a4a4a;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        color: #f0f4f8;
        background-color: #a3b5c8;
    }

    #registrer {
        width: 100%;
        padding: 10px;
        background-color: #ddd;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
</style>

<div class="login-container">
    <section>
        <div style="display: flex; align-items: center;">
            <a href="#" onclick="window.history.back(); return false;" style="color: #4a4a4a; text-decoration: none;">
                <
                    </a>
                    <h1 class="titulos"> Registro</h1>
        </div>
        <form action="index.php?c=usuario&f=new" method="POST" enctype="multipart/form-data">
            <div style="margin: 20px 0px;">
                <label for="nombre">Nombres:</label><br>
                <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre">
            </div>
            <div style="margin: 20px 0px;">
                <label for="apellido">Apellidos:</label><br>
                <input type="text" id="apellido" name="apellido" placeholder="Ingrese sus apellidos">
            </div>
            <div style="margin: 20px 0px;">
                <label for="correo">Correo:</label><br>
                <input type="email" id="correo" name="email" placeholder="Ingrese su correo">
            </div>
            <div style="margin: 20px 0px;">
                <label for="contrasena">Contraseña:</label><br>
                <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña">
            </div>
            <div style="margin: 20px 0px;">
                <label for="imagen">Imagen de perfil:</label><br>
                <input type="file" name="imagen" id="imagen">
            </div>
            <div style="display: flex; align-items: center;">
                <label for="contribuidor">Desea ser Contribuidor:</label>
                <input type="checkbox" id="contribuidor" name="contribuidor" value="1">
            </div>
            <div style="display: flex; justify-content: space-between; margin: 20px 0px;">

                <button type="submit" name="accion" value="registrarse">Registrarse</button>
            </div>
        </form>
    </section>
</div>
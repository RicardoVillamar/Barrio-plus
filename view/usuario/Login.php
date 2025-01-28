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
</style>
<? require_once HEADER; ?>
<div class="login-container">
    <h2>Iniciar Sesión</h2>
    <form action="index.php?c=usuario&f=login" method="POST">
        <div style="margin: 20px 0px;">
            <label for="Nombre">Ingrese su nombre</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre de usuario">
        </div>
        <div style="margin: 20px 0px;">
            <label for="Nombre">Ingrese su contraseña</label>
            <input type="password" id="password" name="password" placeholder="Contraseña">
        </div>
        <button type="submit">Entrar</button>
        <br>
        <p>¿No estas registrado?</p>
        <button id="registrer" onclick="window.location.href='index.php?c=usuario&f=view_new'" type="button">Registrarse</button>
    </form>

    </form>
</div>
<? require_once FOOTER; ?>

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f2f5;
        }
        .registro-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            width: 400px;
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
            background-color: #1877f2;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>

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

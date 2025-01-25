<!--Autor:Palacios Herdoiza Roitman Andres-->
  
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
        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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
            background-color: #1877f2;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        #registrer{
            width: 100%;
            padding: 10px;
            background-color:rgb(149, 188, 211);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form action="index.php?c=usuario&f=login" method="POST">

            <input type="text"  id ="email" name="email" placeholder="Escriba su correo" >
            <input type="password" id ="password" name="password" placeholder="Contraseña" >
            <button  type="submit">Entrar</button>
            <br>
            <p>¿No estas registrado?</p>
            <button id="registrer" onclick="window.location.href='index.php?c=usuario&f=view_new'" type="button">Registrarse</button>
            </form>
            
        </form>
    </div>


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


    <div class="registro-container">
        <h2>Registro de Usuario</h2>
        <form>
            <input type="text" placeholder="Nombre" >
            <input type="text" placeholder="Apellido" >
            <input type="email" placeholder="Correo Electrónico" >
            <input type="password" placeholder="Contraseña" >
            <select required>
                <option value="">Seleccionar Rol</option>
                <option value="1">Administrador</option>
                <option value="2">Usuario</option>
                <option value="3">Invitado</option>
            </select>
            <button  type="submit" >Registrarse</button>
        </form>
    </div>

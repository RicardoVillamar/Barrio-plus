<?php
session_start();
require_once '../../model/dao/UsuarioDAO.php';


$userId = $_SESSION['user_id'];


$usuarioDAO = new UsuarioDAO();
$usuario = $usuarioDAO->selectOne($userId);
?>

<div style="padding: 20px;">
    <h1 class="titulos">Perfil</h1>

    <div class="profile-section" style="background-color: #fff; padding: 20px; border-radius: 8px; margin-top: 20px;">
        <!-- Información básica del usuario -->
        <h2 class="subtitulos"><?php echo $usuario['nombre'] . ' ' . $usuario['apellido']; ?></h2>
        <p class="texto"><?php echo $usuario['correo']; ?></p>
        <p>Datos del usuario</p>
        <button class="boton-mediano">Editar información</button>

        <!-- Opciones de reservación -->
        <div style="margin: 20px 0;">
            <button class="boton-mediano">
                Reservar Herramientas
            </button>
            <button class="boton-mediano">
                Reservar Instalaciones
            </button>
        </div>

        <!-- Historial de reservas -->
        <div style="margin-top: 30px;">
         
            <h2 class="subtitulos">Reservas de Herramientas</h2>
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px;">Herramienta</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Fecha Inicio</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Fecha Fin</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Cantidad</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Estado</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

         
            <h2 class="subtitulos" style="margin-top: 30px;">Reservas de Instalaciones</h2>
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px;">Instalación</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Fecha Inicio</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Fecha Fin</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Propósito</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Estado</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                  
                </tbody>
            </table>
        </div>

     
        <button class="boton-mediano" style="margin-top: 20px;">¡Convertirte en Contribuidor!</button>
    </div>
</div>

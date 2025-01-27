<!-- Autor: Larrea Rosales Alejandro Sebastian -->

<style>
    .dashboard {            
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .dashboard h1 {
            margin-bottom: 20px;
        }
        .contenedor {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
       
</style>
<?php 
$titulo = "Panel Administrador";
require_once HEADER; ?>

<h1 class="titulos">Panel de Administración</h1>
<div class="dashboard">
        
        <div class="contenedor">
            <a href="index.php?c=herramienta&f=index" class="boton-grande">Gestionar Herramientas</a>
            <a href="" class="boton-grande">Gestionar Contribuciones</a>
            <a href="index.php?c=instalacion&f=index_instalacion" class="boton-grande">Gestionar Instalaciones</a>
            <a href="index.php?c=reservacion&f=index" class="boton-grande">Gestionar Reservaciones</a>
        </div>
</div>

<?php require_once FOOTER; ?>
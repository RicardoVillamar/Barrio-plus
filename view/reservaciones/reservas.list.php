<!-- Autor: Larrea Rosales Alejandro Sebastian -->
<?php
$titulo = "Administrar Reservaciones";
require_once HEADER;
?>

<h1 class="titulos">Administrar Reservaciones</h1>

<style>
    table {
        border-collapse: collapse;
        width: 80%;
        margin: 20px auto;
        font-family: Arial, sans-serif;
    }

    thead {
        background-color: #f2f2f2;
    }

    th, td {
        border: 1px solid #dddddd;
        padding: 12px;
        text-align: left;
    }

    th {
        font-weight: bold;
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tbody tr:hover {
        background-color: #e6e6e6;
    }
    
    form {
        text-align: center;
        margin-bottom: 20px;
    }

    input[type="text"] {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 8px;
        width: 70%;
        max-width: 400px;
    }
  
    input[type="submit"] {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #a8d0e6;
        color: white;
        border: none;
        border-radius: 8;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #a3b5c8;
    }
   
    input[type="hidden"] {
        display: none;
    }

</style>

<form action="index.php?c=reservacion&f=index" method="get">
    <input type="hidden" name="c" value="reservacion">
    <input type="hidden" name="f" value="index">
    <input type="text" name="search" placeholder="Buscar reservaciones...">
    <input type="submit" value="Buscar">
</form>

<table align="center" border="1" cellpadding="5" cellspacing="0">
<thead>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Elemento</th>
            <th>Usuario</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reservaciones as $reservacion): ?>
            <tr>
                <td><?php echo $reservacion->getIdReservacion(); ?></td>
                <td><?php echo $reservacion->getTipoElemento(); ?></td>
                <td><?php echo $reservacion->getNombreElemento(); ?></td>
                <td><?php echo $reservacion->getNombreUsuario(); ?></td>
                <td><?php echo $reservacion->getFechaInicio(); ?></td>
                <td><?php echo $reservacion->getFechaFin(); ?></td>
                <td>
                    <?php 
                    $estado = $reservacion->getIdEstadoFK();
                    echo ($estado == 1) ? 'Pendiente' : (($estado == 2) ? 'Aprobado' : 'Cancelado');
                    ?>
                </td>
                <td>
                <a class="boton-pequenio" href="index.php?c=reservacion&f=gestionar&id=<?php 
                echo $reservacion->getIdReservacion(); ?>&tipo=<?php echo $reservacion->getTipoElemento(); ?>&accion=aprobar">Aprobar</a>
                <a class="boton-pequenio" href="index.php?c=reservacion&f=gestionar&id=<?php 
                echo $reservacion->getIdReservacion(); ?>&tipo=<?php echo $reservacion->getTipoElemento(); ?>&accion=cancelar">Cancelar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once FOOTER; ?>
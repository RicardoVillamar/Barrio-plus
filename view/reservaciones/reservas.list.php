
<!-- Autor: Larrea Rosales Alejandro Sebastian -->
<?php
$titulo = "Administrar Reservaciones";
require_once HEADER;
?>

<h1 class="titulos">Administrar Reservaciones</h1>
<table align="center" border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Recurso</th>
            <th>Usuario</th>
            <th>Tipo</th>
            <th>Cantidad / Personas</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reservaciones as $reserva): ?>
            <tr>
                <td><?php echo $reserva['idReservacion']; ?></td>
                <td><?php echo $reserva['recurso']; ?></td>
                <td><?php echo $reserva['usuario']; ?></td>
                <td><?php echo $reserva['tipo']; ?></td>
                <td><?php echo $reserva['detalle']; ?></td>
                <td><?php echo $reserva['fechaInicio']; ?></td>
                <td><?php echo $reserva['fechaFin']; ?></td>
                <td><?php echo $reserva['estado']; ?></td>
                <td>
                    <form action="index.php?c=reservaciones&f=aprobar" method="POST" style="display:inline;">
                        <input type="hidden" name="idReservacion" value="<?php echo $reserva['idReservacion']; ?>">
                        <button style="font-size: 0.8rem" type="submit" class="boton-pequenio">Aprobar</button>
                    </form>
                    <form action="index.php?c=reservaciones&f=cancelar" method="POST" style="display:inline;">
                        <input type="hidden" name="idReservacion" value="<?php echo $reserva['idReservacion']; ?>">
                        <button style="font-size: 0.8rem" type="submit" class="boton-pequenio">Cancelar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once FOOTER; ?>
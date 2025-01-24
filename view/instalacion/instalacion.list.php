<?php
//Autor: Villamar Minuche Ricardo Daniel
require_once HEADER
?>
<main id="main">


    <div class="principal">
        <div
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <a class="boton-mediano reserva"
                href="index.php?c=instalacion&f=new_instalacion">Regitrar instalacion</a>
        </div>

        <section style="display: flex; justify-content: center; overflow-x: auto">

            <table style="background-color: white; border-radius: 8px">
                <thead style="border-bottom: 1px solid brown">
                    <tr>
                        <th class="tabla-titulos">Id</th>
                        <th class="tabla-titulos">Nombre</th>
                        <th class="tabla-titulos">Descripcion</th>
                        <th class="tabla-titulos">Precio</th>
                        <th class="tabla-titulos">Tamaño</th>
                        <th class="tabla-titulos">Tipo</th>
                        <th class="tabla-titulos">Estado</th>
                        <th class="tabla-titulos">Contribuidor</th>
                        <th class="tabla-titulos">Imagen</th>
                        <th class="tabla-titulos">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($resultados as $row) {
                    ?>
                        <tr>
                            <td><?php echo $row['idInstalacion'] ?></td>
                            <td><?php echo $row['nombre_instalacion'] ?></td>
                            <td><?php echo $row['descripcion'] ?></td>
                            <td><?php echo $row['precio'] ?></td>
                            <td><?php echo $row['tamano'] ?></td>
                            <td><?php echo $row['tipo_nombre'] ?></td>
                            <td><?php echo $row['estado_nombre'] ?></td>
                            <td><?php echo $row['contribuidor_nombre'] ?></td>
                            <td><?php echo isset($row['imagen']) ? $row['imagen'] : 'No image available'; ?></td>
                            <td>
                                <a class="boton-mediano reserva" style="margin-bottom: 10px;" href="index.php?c=instalacion&f=view_editar&id=<?php echo $row['idInstalacion'] ?>">Editar</a>
                                <a class="eliminar"
                                    onclick="if(!confirm('Esta seguro de eliminar el producto?')) return false;" href="index.php?c=instalacion&f=view_eliminar&id=<?php echo $row['idInstalacion'] ?>">Eliminar</a>
                            </td>
                        </tr>

                    <?php
                    }
                    ?>
                </tbody>
            </table>

        </section>

    </div>
</main>


<?php require_once FOOTER ?>
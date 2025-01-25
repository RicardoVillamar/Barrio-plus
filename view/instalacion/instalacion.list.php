<?php
//Autor: Villamar Minuche Ricardo Daniel
require_once HEADER
?>
<div class="cabecera-reserva">
    <a href="index.php?c=instalacion&f=index" style="padding: 0px; margin-left: 10px">
        <span class="material-symbols-outlined"> arrow_back_ios_new </span>
    </a>
    <h1 style="padding: 0px 10px; font-size: 1.5rem;">
        Instalaciones
    </h1>
</div>
<main id="main">

    <div class="principal">
        <div style="margin: 0px 20px;">
            <div
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; width: 100%">

                <div class="buscar">
                    <a style="display: flex; justify-content: start;" href="">Buscar</a>
                    <input type="text" class="input" placeholder="Nombre de la instalación">
                </div>

                <a class="boton-mediano reserva"
                    href="index.php?c=instalacion&f=new_instalacion"> + Regitrar instalacion</a>
            </div>

            <section style=" display: flex; justify-content: center; overflow-x: auto; width: 100%">

                <table style="background-color: white; border-radius: 8px; width: 100%">
                    <thead style="border-bottom: 1px solid brown">
                        <tr>
                            <th class="tabla-titulos">Id</th>
                            <th class="tabla-titulos">Nombre</th>
                            <th class="tabla-titulos">Imagen</th>
                            <th class="tabla-titulos">Descripcion</th>
                            <th class="tabla-titulos">Precio</th>
                            <th class="tabla-titulos">Tamaño</th>
                            <th class="tabla-titulos">Tipo</th>
                            <th class="tabla-titulos">Estado</th>
                            <th class="tabla-titulos">Contribuidor</th>
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
                                <td>
                                    <?php if ($row['imagen']) { ?>
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['imagen']); ?>" alt="Imagen" class="imagen-tabla">
                                    <?php } else { ?>
                                        <span>No disponible</span>
                                    <?php } ?>
                                </td>
                                <td><?php echo $row['descripcion'] ?></td>
                                <td><?php echo $row['precio'] ?></td>
                                <td><?php echo $row['tamano'] ?></td>
                                <td><?php echo $row['tipo_nombre'] ?></td>
                                <td><?php echo $row['estado_nombre'] ?></td>
                                <td><?php echo $row['contribuidor_nombre'] ?></td>
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
    </div>
</main>


<?php require_once FOOTER ?>
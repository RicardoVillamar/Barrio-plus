<!--Autor: Quiñonez Castrellón Anthony Joel-->
<?php require_once HEADER?>
<div style="display: flex; align-items: center;">
    <a href="index.php?c=herramienta&f=index" style="padding: 0px; margin-left: 10px">
        <span class="material-symbols-outlined"> arrow_back_ios_new </span>
    </a>
    <h3 style="margin-left: 10px;">Herramientas</h3>
</div>
<main id="main">

    <div class="principal">
        <div style="margin: 0px 20px;">
            <div
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; width: 100%">

                <div class="buscar">
                    <form action="index.php?c=herramienta&f=search" method="POST">
                        <input type="text" class="input" name="b" placeholder="Nombre de la herramienta">
                        <button type="submit" class="boton-mediano">Buscar</button>
                    </form>
                </div>

                <a class="boton-mediano reserva"
                    href="index.php?c=herramienta&f=new_Herramienta"> + Regitrar Herramienta</a>
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
                            <th class="tabla-titulos">Estado</th>
                            <th class="tabla-titulos">Registro</th>
                            <th class="tabla-titulos">Mantenimiento</th>
                            <th class="tabla-titulos">Cantidad</th>
                            <th class="tabla-titulos">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($resultado as $row) {
                        ?>
                            <tr>
                                <td><?php echo $row['idHerramienta'] ?></td>
                                <td><?php echo $row['nombre'] ?></td>
                                <td>
                                    <?php if ($row['imagen']) { ?>
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['imagen']); ?>" alt="Imagen" class="imagen-tabla">
                                    <?php } else { ?>
                                        <span>No disponible</span>
                                    <?php } ?>
                                </td>
                                <td><?php echo $row['descripcion'] ?></td>
                                <td><?php echo $row['precio'] ?></td>
                                <td><?php echo $row['estado_nombre'] ?></td>
                                <td><?php echo $row['fechaRegistro'] ?></td>
                                <td><?php echo $row['mantenimiento'] ?></td>
                                <td><?php echo $row['cantidad'] ?></td>

                                <td>
                                    <a class="boton-mediano reserva" style="margin-bottom: 10px;" href="index.php?c=herramienta&f=view_editar&id=<?php echo $row['idHerramienta'] ?>">Editar</a>
                                    <a class="eliminar"
                                        onclick="if(!confirm('Esta seguro de eliminar el producto?')) return false;" href="index.php?c=herramienta&f=view_eliminar&id=<?php echo $row['idHerramienta'] ?>">Eliminar</a>
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

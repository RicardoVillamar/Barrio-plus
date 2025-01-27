<!--Autor: Quiñonez Castrellón Anthony Joel-->
<?php require_once HEADER; ?>
<main id="main">
    <div class="principal">
        <section class="cabezera">
            <div style="display: flex; flex-direction: column; gap: 10px; margin: 10px;">
                <h1 style="font-size: 1.5rem;">Herramienta</h1>
                <?php if (isset($rol) && $rol == '1'): ?>
                <a href="index.php?c=herramienta&f=index">Ingresar Herramienta</a>
                <?php endif; ?>
            </div>
            <div class="buscar">
                <form action="index.php?c=herramienta&f=searchReserva" method="post" style="display: flex; align-items: center;">
                    <input name="b" placeholder="Nombre de la Herramietna" type="text"
                        style="padding: 20px 20px; padding-right: 30px; margin: 10px; border-radius: 8px; border: 1px solid rgba(0, 0, 0, 0.1);height: 30px;"
                        id="buscar" />
                    <button type="submit" for="buscar-barra" class="boton-mediano" style="font-weight: bold;">Buscar</button>
                </form>
            </div>


        </section>
        <section
            style="display: flex; justify-content: center; overflow-x: auto">
            <table style="background-color: white; border-radius: 8px">
                <thead style="border-bottom: 1px solid brown">
                    <tr>
                        <th class="tabla-titulos">Estado</th>
                        <th class="tabla-titulos">Herramienta</th>
                        <th class="tabla-titulos">Cantidad</th>
                        <th class="tabla-titulos">Mantenimiento</th>
                        <th class="tabla-titulos">Reservar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($resultado as $row) {
                    ?>
                        <tr>
                            <td><?php echo $row['estado_nombre'] ?></td>
                            <td>
                                <p class="texto nombre-herramienta"><?php echo $row['nombre'] ?></p>
                                <?php if ($row['imagen']) { ?>
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($row['imagen']); ?>" alt="Imagen" class="imagen-tabla">
                                <?php } else { ?>
                                    <span>No disponible</span>
                                <?php } ?>
                            </td>
                            <td> <span class="texto cantidad"><?php echo $row['cantidad'] ?></span>
                            </td>
                            <td>
                                <span class="texto"><?php echo $row['mantenimiento'] ?></span>
                            </td>
                            <td>
                                <p class="texto"><?php echo $row['precio'] ?></p>
                                <?php
                                if ($row['estado_nombre'] === 'Libre') {
                                ?>

                                    <a class="boton-mediano reserva" href="index.php?c=herramienta&f=view_reservar&id=<?php echo $row['idHerramienta'] ?>">Reservar</a>

                                <?php
                                } else {
                                ?>
                                    <span class="texto">No disponible</span>
                                <?php
                                }
                                ?>

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
<?php require_once FOOTER; ?>

<!--Autor: Quiñonez Castrellón Anthony Joel-->
<?php require_once HEADER; ?>
<main id="main">
    <div class="principal">
        <section class="cabezera">
            <div style="display: flex; flex-direction: column; gap: 10px; margin: 10px;">
                <h1 style="font-size: 1.5rem;">Herramienta</h1>
                <a href="index.php?c=herramienta&f=index">Ingresar Herramienta</a>
            </div>
            <div class="buscar">
                <label for="buscar-barra" class="texto" style="font-weight: bold">Buscar</label>
                <input placeholder="Nombre de la Herramienta" type="text" id="buscar-barra"
                    style=" padding: 0 10px; padding-right: 30px; margin: 10px; border-radius: 4px; border: 1px solid rgba(0, 0, 0, 0.1);
                    height: 30px;" />
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

                                <a class="boton-mediano reserva" href="index.php?c=herramienta&f=view_reservar&id=<?php echo $row['idHerramienta'] ?>">Reservar</a>

                            </td>
                        </tr>

                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <aside class="filtro">
        <h2 class="subtitulos">Filtros</h2>
    <section>
        <p class="texto">Estado</p>
            <select id="estado" name="estado" style="width: 90%; height: 25px; border-radius: 4px">
                <option value="todos">Todos</option>
                <?php
                foreach ($estados as $fila) {
                ?>
                    <option value="<?php echo $fila['idEstado']; ?>"><?php echo $fila['nombre']; ?></option>
                <?php
                }
                ?>
            </select>
            <button type="submit" style="margin-top: 10px; padding: 5px 10px;">Buscar</button>
    </section>
    </aside>
</main>
<?php require_once FOOTER; ?>

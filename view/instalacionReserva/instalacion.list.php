<?php
//Autor: Villamar Minuche Ricardo Daniel
require_once HEADER; ?>
<main id="main">
    <!-- Filtro -->
    <aside class="filtro">
        <h2 class="subtitulos">Filtros</h2>
        <section>
            <p class="texto">Estado</p>
            <select id="estado" style="width: 90%; height: 25px; border-radius: 4px">
                <option value="todos">Todos</option>
                <?php
                foreach ($estados as $fila) {
                ?>
                    <option value="<?php echo $fila['idEstado']; ?>"><?php echo $fila['nombre']; ?></option>
                <?php
                }
                ?>
            </select>
        </section>

        <section>
            <p class="texto">Tipos</p>
            <ul>
                <li>
                    <label class="texto">
                        <input type="radio" name="tipos" value="todos" />
                        Todos
                    </label>
                </li>
                <?php
                foreach ($tipos as $fila) {
                ?>
                    <li>
                        <label class="texto">
                            <input type="radio" name="tipos" value="<?php echo $fila['idTipo']; ?>" />
                            <?php echo $fila['nombre']; ?>
                        </label>
                    </li>

                <?php
                }
                ?>
            </ul>
        </section>
    </aside>
    <!-- Main -->
    <div class="principal">
        <!-- Cabecera -->
        <section class="cabezera">
            <div style="display: flex; flex-direction: column; gap: 10px; margin: 10px;">
                <h1>Instalaciones</h1>
                <a href=" index.php?c=instalacion&f=index_instalacion">Ingresar instalacion</a>
            </div>
            <div class="buscar">
                <form action="index.php?c=instalacion&f=searchReservas" method="post" style="display: flex; align-items: center;">

                    <input
                        name="buscar"
                        placeholder="Nombre de la instalación"
                        type="text"
                        style="padding: 20px 20px;
                                    padding-right: 30px;
                                    margin: 10px;
                                    border-radius: 8px;
                                    border: 1px solid rgba(0, 0, 0, 0.1);
                                    height: 30px;"
                        id="buscar-barra" />
                    <button type="submit" for="buscar-barra" class="boton-mediano" style="font-weight: bold;">Buscar</button>
                </form>
            </div>

        </section>
        <!-- Tabla -->
        <section
            style="display: flex; justify-content: center; overflow-x: auto">
            <table style="background-color: white; border-radius: 8px">
                <thead style="border-bottom: 1px solid brown">
                    <tr>
                        <th class="tabla-titulos">Estado</th>
                        <th class="tabla-titulos">Instalación</th>
                        <th class="tabla-titulos">Tamaño</th>
                        <th class="tabla-titulos">Tipo</th>
                        <th class="tabla-titulos">Reservar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($resultados as $row) {
                    ?>
                        <tr>
                            <td><?php echo $row['estado_nombre'] ?></td>
                            <!-- <td class="imagen"> -->
                            <td>
                                <?php if ($row['imagen']) { ?>
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($row['imagen']); ?>" alt="Imagen" class="imagen-tabla">
                                <?php } else { ?>
                                    <span>No disponible</span>
                                <?php } ?>
                                <p class="texto nombre-instalacion"><?php echo $row['nombre_instalacion'] ?></p>
                            </td>
                            <td> <span class="texto tam-instalacion"><?php echo $row['tamano'] ?></span>
                                <!-- <span class="texto tam-instalacion">Grande</span> -->
                            </td>
                            <td>
                                <span class="texto"><?php echo $row['tipo_nombre'] ?></span>
                            </td>
                            <td>
                                <p class="texto"><?php echo $row['precio'] ?></p>
                                <?php
                                if ($row['estado_nombre'] === 'Libre') {
                                ?>
                                    <a class="boton-mediano reserva" href="index.php?c=instalacion&f=view_reservar&id=<?php echo $row['idInstalacion'] ?>">Reservar</a>
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
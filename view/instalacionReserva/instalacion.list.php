<!-- Autor: Villamar Minuche Ricardo Daniel -->

<?php require_once HEADER; ?>
<main id="main">
    <!-- Filtro -->
    <aside class="filtro">
        <h2 class="subtitulos">Filtros</h2>
        <section>
            <p class="texto">Estado</p>
            <select id="estado" style="width: 90%; height: 25px; border-radius: 4px">
                <?php
                // Iterar sobre los estados y mostrarlos en el select
                foreach ($estados as $fila) {
                ?>
                    <option value="<?php echo $fila['idEstado']; ?>"><?php echo $fila['nombre']; ?></option>
                <?php
                }
                ?>
            </select>
        </section>
        <!-- 
        <section>
            <p class="texto">Tamaño</p>
            <ul>
                <li>
                    <label class="texto">
                        <input type="radio" name="tamanio" value="todos" />
                        Todos
                    </label>
                </li>
                <li>
                    <label class="texto">
                        <input type="radio" name="tamanio" value="grande" />
                        Grande
                    </label>
                </li>
                <li>
                    <label class="texto">
                        <input type="radio" name="tamanio" value="mediano" />
                        Mediano
                    </label>
                </li>

                <li>
                    <label class="texto">
                        <input type="radio" name="tamanio" value="pequeño" />
                        Pequeño
                    </label>
                </li>
            </ul>
        </section> -->
        <section>
            <p class="texto">Tipos</p>
            <ul>
                <li>
                    <label class="texto">
                        <input type="radio" name="tipos" value="todos" />
                        Todos
                    </label>
                </li>
                <li>
                    <label class="texto">
                        <input type="radio" name="tipos" value="aire" />
                        Aire libre
                    </label>
                </li>
                <li>
                    <label class="texto">
                        <input type="radio" name="tipos" value="aula" />
                        Aula
                    </label>
                </li>
                <li>
                    <label class="texto">
                        <input type="radio" name="tipos" value="salon" />
                        Salón
                    </label>
                </li>
                <li>
                    <label class="texto">
                        <input type="radio" name="tipos" value="taller" />
                        Taller
                    </label>
                </li>
            </ul>
        </section>
    </aside>
    <!-- Main -->
    <div class="principal">
        <!-- Cabecera -->
        <section class="cabezera">
            <h2 class="titulo-buscar titulos">Instalaciones</h2>
            <div class="buscar">
                <label for="buscar-barra" class="texto" style="font-weight: bold">Buscar</label>
                <input
                    placeholder="Nombre de la instalación"
                    type="text"
                    id="buscar-barra"
                    style="
                padding: 0 10px;
                padding-right: 30px;
                margin: 10px;
                border-radius: 4px;
                border: 1px solid rgba(0, 0, 0, 0.1);
                height: 30px;
              " />
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
                                <!-- <img
                                    src="../../assets/img/instalaciones/salon-comunal.png"
                                    alt="saloncomunal"
                                    class="imagen-tabla" /> -->
                                <!-- <p class="texto nombre-instalacion">Salon comunal</p> -->
                                <?php echo isset($row['imagen']) ? $row['imagen'] : 'No image available'; ?>

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

                                <a class="boton-mediano reserva" href="index.php?c=instalacion&f=view_reservar&id=<?php echo $row['idInstalacion'] ?>">Reservar</a>
                                <!--
                                <button class="boton-mediano reserva">Reservar</button> -->
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
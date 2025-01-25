
<!-- autor: Quiñonez Castrellón Anthony Joel -->
<?php require_once HEADER; ?>

<main id="main">
<div class="principal">
        <!-- Cabecera -->
        <section class="cabe">
            <div style="display: flex; flex-direction: column; gap: 10px; margin: 10px;">
                <h2 class="titulo-buscar titulos">Herramientas</h2>
                <a href="index.php?c=herramienta&f=index">Ingresar instalacion</a>
            </div>
            <div class="buscar">
                <label for="buscar-barra" class="texto" style="font-weight: bold">Buscar</label>
                <form action="index.php?c=herramienta&f=searchnombre" method="POST">
                <input
                    placeholder="Nombre de la Herramienta"
                    type="text"
                    id="buscar-barra"
                    style="padding: 0 10px;padding-right: 30px;margin: 10px;border-radius: 4px;
                    border: 1px solid rgba(0, 0, 0, 0.1);height: 30px;" /></div>

        </section>
        <!-- Tabla -->
        <section
            style="display: flex; justify-content: center; overflow-x: auto">
            <table style="background-color: white; border-radius: 8px">
                <thead style="border-bottom: 1px solid brown">
                    <tr>
                        <th class="tabla-titulos">Estado</th>
                        <th class="tabla-titulos">Herramienta</th>
                        <th class="tabla-titulos">Imagen</th>
                        <th class="tabla-titulos">Descripcion</th>
                        <th class="tabla-titulos">Reservar</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                foreach ($resultado as $row) { ?>
                <tr>
                    <td><?php echo $row['idEstadoFK'] ?? ''; ?></td>
                    <td><?php echo $row['nombre'] ?? ''; ?></td>
                    <td><?php echo $row['imagen'] ?? ''; ?></td>
                    <td><?php echo $row['descripcion'] ?? ''; ?></td>
                    <td>
                        <p class="texto"><?php echo $row['precio'] ?? ''; ?></p>
                        <a class="boton-mediano reserva" href="index.php?c=herramienta&f=view_reservar&id=<?php echo $row['idHerramienta']; ?>">Reservar</a>
                    </td>
                </tr>
                <?php } ?>

                </tbody>
            </table>
        </section>
    </div>

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
    </aside>
    <!-- Main -->
</main>
<?php require_once FOOTER; ?>
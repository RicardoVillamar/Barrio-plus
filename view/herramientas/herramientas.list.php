<!-- autor: Quiñonez Castrellón Anthony Joel -->
<?php require_once HEADER; ?>
<link rel="stylesheet" href="assets/css/herramientasStyle.css" />

<main class="containt">
<h2> <?php echo $titulo?></h2>
<div class="tabla">
    <div>
        <h2> </h2>
        <div>
            <div class="buscar">
                <a href="index.php?c=herramienta&f=view_new"> 
                    <button type="button" class="crear">
                    Nuevo</button></a>

                <div class="search">
                    <form action="index.php?c=herramienta&f=search" method="POST">
                    <input type="text" name="b" id="busqueda"  placeholder="Buscar por nombre"/>
                    <button type="submit" class="">Buscar</button>
                </div>
        </div>

    <table>
        <thead>
            <tr>
                <th class="tabla-titulos">ID</th>
                <th class="tabla-titulos">Nombre</th>
                <th class="tabla-titulos">Imagen</th>
                <th class="tabla-titulos" >Descripción</th>
                <th class="tabla-titulos">Precio</th>
                <th class="tabla-titulos">Fecha Registro</th>
                <th class="tabla-titulos">Estado</th>
                <th class="tabla-titulos">Mantenimiento</th>
                <th class="tabla-titulos">Cantidad</th>
                <th class="tabla-titulos">Contribuidor</th>
                <th class="tabla-titulos">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                    foreach ($resultado as $row) { ?>
                        <tr>
                            <td><?php echo $row['idHerramienta']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['imagen'];?></td>
                            <td><?php echo $row['descripcion']; ?></td>
                            <td><?php echo $row['precio']; ?></td>
                            <td><?php echo $row['fechaRegistro']; ?></td>
                            <td><?php echo $row['idEstadoFK']; ?></td>
                            <td><?php echo $row['mantenimiento']; ?></td>
                            <td><?php echo $row['cantidad']; ?></td>
                            <td><?php echo $row['idContribuidorFK']; ?></td>
                            <td>
                                <a class="edit" href="index.php?c=herramienta&f=view_edit&id=<?php echo $row['idHerramienta']; ?>">Editar</a> | 
                                <a class="delete" href="index.php?c=herramienta&f=delete&id=<?php echo $row['idHerramienta']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta herramienta?');">Eliminar</a>
                                </td>
                        </tr>
                        <?php
                    }
            ?>
        </tbody>
    </table>
</div>
</main>

<?php require_once FOOTER; ?>

<!-- autor: Quiñonez Castrellón Anthony Joel -->
<?php require_once HEADER; ?>
<main>
<div class="tabla">
    <div>
        <h2> </h2>
        <div>
            <div>
                <form action="index.php?c=herramientas&f=search" method="POST">
                <input type="text" name="b" id="busqueda"  placeholder="buscar..."/>
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>Buscar</button>
            </form>       
        </div>
        <div>
            <a href="view/herramientas/herramientas.new.php"> 
                <button type="button">
                    <i ></i> Nuevo</button></a>
            </div>
            <div>
    <table cellspacing="0" cellpadding="5" style="width: 100%; text-align: center;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Fecha Registro</th>
                <th>Estado</th>
                <th>Mantenimiento</th>
                <th>Cantidad</th>
                <th>Contribuidor</th>
                <th>Acciones</th>
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
                                <a class="edit" href="index.php?c=herramientas&f=view_edit&id=<?php echo $row['idHerramienta']; ?>" style="color: blue;">Editar</a> | 
                                <a class="delete" href="index.php?c=herramientas&f=delete&id=<?php echo $row['idHerramienta']; ?>" 
                                   style="color: red;" 
                                   onclick="return confirm('¿Está seguro de eliminar esta herramienta?');">Eliminar</a>
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
<!-- Autor: Freire Chavez Jose Andres -->
<?php require_once HEADER; ?>
  <div class="container">
    <h1>Contribuidor</h1>
    <div class="search-bar">
      <input type="text" placeholder="Buscar Contribuciones">
      <a href="index.php?c=contribucion&f=view_new" class="btn" id="btnNuevo">
        <span>+ </span>Nuevo
      </a>
    </div>
    <table id="tablaContribuciones">
        <thead>
            <tr>
                <th>idContribucion</th>
                <th>idHerramienta</th>
                <th>idInstalacion</th>
                <th>idUsuario</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
                <?php
                    foreach($resultados as $fila){
                ?>
                    <tr>
                        <td><?php echo $fila['idContribucion']?> </td>
                        <td><?php echo $fila['idHerramienta']?> </td>
                        <td><?php echo $fila['idInstalacion']?> </td>
                        <td><?php echo $fila['idUsuario']?> </td>
                        <td><?php echo $fila['fechaEvento']?> </td>
                        <td><?php echo $fila['nombre']?> </td>
                        <td><?php echo $fila['apellido']?> </td>
                        <td><?php echo $fila['correo']?> </td>
                        <td>
                            <a class="btn" id="btnEditar" href="index.php?c=contribucion&f=view_edit&id=<?php echo $fila['idContribucion'];?>">Editar</a>
                            <a onclick="if(!confirm('Esta seguro de eliminar el producto?'))return false;"
                            class="btn" id="btnEliminar" href="index.php?c=contribucion&f=delete&id=<?php echo $fila['idContribucion'];?>">Eliminar</a>
                        </td>
                    </tr>
                <?php 
                    }
                ?>
            </tbody>
        </table>
    </div>
<?php require_once FOOTER; ?>

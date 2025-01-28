<!-- Autor: Freire Chavez Jose Andres -->
 <style>
    .search-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .search-bar form {
        display: flex;
        gap: 10px;
    }
    
 </style>
<?php require_once HEADER; ?>
  <div class="contenedorContri">
    <h1 style="margin-left:5px;">Contribuciones</h1>
    <div style="margin-right:30px;" class="search-bar">
      <form action="index.php?c=contribucion&f=search" method="POST">
        <input type="text" name="buscar" placeholder="Buscar Contribuciones">
        <input type="submit" value="Buscar" class="boton-mediano">
      </form>
      <a class="boton-mediano" style="width:100px; height:40px;" href="index.php?c=contribucion&f=view_new" >
        <span>+ </span>Nuevo
      </a>
    </div>
    <table id="tablaContribuciones">
        <thead>
            <tr>
                <th>idContribucion</th>
                <th>Herramienta</th>
                <th>Instalacion</th>
                <th>Correo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
                <?php
                    foreach($resultados as $fila){
                ?>
                    <tr>
                        <td><?php echo $fila['idContribucion']?> </td>
                        <td><?php echo $fila['nombreHerramienta']?> </td>
                        <td><?php echo $fila['nombreInstalacion']?> </td>
                        <td><?php echo $fila['correoUsuario']?> </td>
                        <td><?php echo $fila['estado']?> </td>
                        <td>
                            <a class="boton-mediano" href="index.php?c=contribucion&f=view_edit&id=<?php echo $fila['idContribucion'];?>">Editar</a>
                            <a onclick="if(!confirm('Esta seguro de eliminar la contribucion?'))return false;"
                            class="boton-mediano" href="index.php?c=contribucion&f=delete&id=<?php echo $fila['idContribucion'];?>">Eliminar</a>
                        </td>
                    </tr>
                <?php 
                    }
                ?>
            </tbody>
        </table>
    </div>
<?php require_once FOOTER; ?>

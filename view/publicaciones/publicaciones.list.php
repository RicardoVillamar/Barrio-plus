<!-- Autor: Freire Chavez Jose Andres -->
<?php require_once HEADER; ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/listPublicacionStyle.css">
    <link rel="icon" href="assets/images/fotos/logo-icon.png" type="image/png">
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
      rel="stylesheet"
    />
    <title>Publicaciones</title>
  </head>
  <body>
    <?php require_once HEADER; ?>
    <section class="formularios" id="buscarFormPublicaciones">
    <h4 class="titulos"><?php echo $titulo ?></h4>
        <form action="index.php?c=publicacion&f=search" method="POST">
            <input type="text" name="buscar" id="buscarPublicaciones">
            <button type="submit" value="Buscar" class="btn" id="btnBuscar">
        </form>
    </section>
    <br/>
    <a href="index.php?c=publicacion&f=new" class="btn" id="btnAgregar">
        <span>+ </span>Nuevo
    </a>
    <table id="tablaPublicaciones">
        <thead>
            <tr>
                <th>Título</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Prioridad</th>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
            </tr>
        </thead>
        <tbody>
                <?php
                    foreach($resultados as $fila){
                ?>
                    <tr>
                        <td><?php echo $fila['titulo']?> </td>
                        <td><?php echo $fila['tipo']?> </td>
                        <td><?php echo $fila['descripcion']?> </td>
                        <td><?php echo $fila['prioridad']?> </td>
                        <td><?php echo $fila['fechaEvento']?> </td>
                        <td><?php echo $fila['nombre']?> </td>
                        <td><?php echo $fila['apellido']?> </td>
                        <td><?php echo $fila['correo']?> </td>
                        <td>
                            <a class="btn"  href="index.php?c=publicacion&f=view_edit&id=<?php echo $fila['idPubli'];?>">Editar</a>
                            <a onclick="if(!confirm('Esta seguro de eliminar el producto?'))return false;"
                            class="btn" href="index.php?c=publicacion&f=delete&id=<?php echo $fila['idPubli'];?>">Eliminar</a>
                        </td>
                    </tr>

                <?php 
                    }
                ?>
            </tbody>
        </table>
<?php require_once FOOTER; ?>
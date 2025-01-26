<?php
if (!isset($_SESSION)) {
  session_start();
}
if (isset($_SESSION['usuario'])) {
  $usuario = $_SESSION['usuario'];
  $rol = $usuario['idRolFK'];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="assets/css/newPublicacionStyle.css">
  <link rel="stylesheet" href="assets/css/listPublicacionStyle.css">
  <link rel="stylesheet" href="assets/css/instalacionStyle.css">
  <link rel="stylesheet" href="assets/css/instalacion2Style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/usuario.css">
  <link rel="stylesheet" href="assets/css/newContribucionStyle.css">
  <link rel="icon" href="assets/images/fotos/logo-icon.png" type="image/png">
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
    rel="stylesheet" />
  <title>
    <?php echo $titulo ?>
  </title>
</head>

<body>
  <nav id="navbar">
    <div class="navbar-logo">
      <a href="index.php">
        <img class="logo" src="assets/images/fotos/logo-icon.png" alt="logo" />
      </a>
    </div>
    <ul class="navbar-menu">
      <li><a href="index.php?c=instalacion&f=index">Instalaciones</a></li>
      <li><a href="index.php?c=herramienta&f=index_Herramienta">Herramientas</a></li>
      <li><a href="index.php?c=historial&f=index">Historial</a></li>
      <li><a href="index.php?c=index&f=index&p=nosotros">Nosotros</a></li>
      <?php if (isset($rol) && $rol == '1'): ?>
        
        <li><a href="index.php?c=reservacion&f=listar">Reservaciones</a></li>
      <?php endif; ?>
      <li>
        <a href="index.php?c=usuario&f=profile" class="user">
          <span class="material-symbols-outlined">account_circle</span>
        </a>
      </li>
    </ul>
  </nav>

  <?php       
    if (!empty($_SESSION['mensaje'])) {
        ?>
        <div class="mt-2 alert alert-<?php echo $_SESSION['color']; ?>
        alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['mensaje']; ?>  
        </div>
        <?php
        unset($_SESSION['mensaje']);
        unset($_SESSION['color']);
    }
  ?>
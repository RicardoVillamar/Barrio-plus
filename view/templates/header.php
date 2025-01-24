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
    <a href="index.php">
      <img class="logo" src="assets/images/fotos/logo-icon.png" alt="logo" />
    </a>
    <ul>
      <li><a href="index.php?c=instalacion&f=index">Instalaciones</a></li>
      <li><a href="index.php?c=herramienta&f=index">Herramientas</a></li>
      <li><a href="index.php?c=historial&f=index">Historial</a></li>
      <li><a href="index.php?c=index&f=index&p=nosotros">Nosotros</a></li>
      <li>
        <a href="#" class="user">
          <span class="material-symbols-outlined"> account_circle </span>
        </a>
      </li>
    </ul>
  </nav>
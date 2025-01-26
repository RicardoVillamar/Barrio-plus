<?php require_once HEADER; ?>
  <div class="container">
    <h1>Contribuidor</h1>
    <div class="search-bar">
      <input type="text" placeholder="Buscar Contribuciones">
      <a href="index.php?c=contribucion&f=view_new" class="btn" id="btnNuevo">
        <span>+ </span>Nuevo
      </a>
    </div>
    <div class="contributions">
      <div class="contribution">
        <span>Herramienta nueva</span>
        <div>
          <button>Editar</button>
          <button>Eliminar</button>
        </div>
      </div>
      <div class="contribution">
        <span>Instalación nueva</span>
        <div>
          <button>Editar</button>
          <button>Eliminar</button>
        </div>
      </div>
    </div>
  </div>
<?php require_once FOOTER; ?>

<?php

  @SESSION_START();

?>

<nav class="navbar navbar-expand-lg navbar-light bg-danger">
  <a class="navbar-brand" href="#"> <?php echo $_SESSION["nombre"]; ?> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="frm_cursos.php"><i class="bi bi-0-circle"> Ir al menú principal </i><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../acc/acc_cerrar_sesion.php">Cerrar sesión</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled">Disabled</a>
      </li>
    </ul>
  </div>
</nav>
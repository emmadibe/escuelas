<?php

  @SESSION_START();

  include "conexion.php";

  $sql = "SELECT * FROM docentes WHERE docente_id = ".$_SESSION["docente_id"]."";
  $res = mysqli_query($link, $sql);
  $mostrar = mysqli_fetch_array($res);
  
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

      <?php if(($mostrar["rol_id"]) == 1){ //La idea es que solo los administradores (rol_id == 1) puedan ver a todos los docentes que hay para poder hacerles modificaciones.  ?>

        <li class="nav-item">
          <a class="nav-link" href="frm_ver_todos_docentes.php">Ver docentes</a>
        </li>

      <?php } ?>

      <li class="nav-item">
        <a class="nav-link disabled">Disabled</a>
      </li>
    </ul>
  </div>
</nav>
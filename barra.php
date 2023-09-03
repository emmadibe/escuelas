<?php
@session_start();

include "conexion.php";

// Get the docente_id from the session
$docente_id = $_SESSION["docente_id"];

// Query to get the docente details
$sql = "SELECT * FROM docentes WHERE docente_id = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "i", $docente_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$mostrar = mysqli_fetch_assoc($res);

/*
// Get the profile picture path from the database
$sql_foto = "SELECT foto_perfil FROM docentes WHERE docente_id = ?";
$stmt = mysqli_prepare($link, $sql_foto);
mysqli_stmt_bind_param($stmt, "i", $docente_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $foto);
*/
?>
  

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap, extensión de paletas de colores. Es para tener, entre otros, el color morado -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  </head>

  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-danger">

    <a class="navbar-brand" href="#">
      <img src="<?php echo $foto; ?>" alt="Foto del docente">
      <?php echo $_SESSION["nombre"]; ?>
    </a>


      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="frm_cursos.php"><i class="bi bi-0-circle"> Ir al menú principal </i><span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
          <button type="button" class="btn btn-transparent" data-toggle="modal" data-target="#modal_cargar_foto">
              <i class="bi bi-cloud-arrow-up"></i>Cargar foto de perfil
          </button>

            <!-- Al escribir la clase btn btn-transparent, el botón adopatará el color de fondo. -->
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../acc/acc_cerrar_sesion.php"><i class="bi bi-person-fill-slash">Cerrar sesión</i></a>
          </li>

          <?php if(($mostrar["rol_id"]) == 1){ //La idea es que solo los administradores (rol_id == 1) puedan ver a todos los docentes que hay para poder hacerles modificaciones.  ?>

            <li class="nav-item">
              <a class="nav-link" href="frm_ver_todos_docentes.php"><i class="bi bi-zoom-in">Ver docentes</i></a>
            </li>
          <?php } ?>

        </ul>
      </div>
    </nav>

    
                            <!--  --------------MODAL CARGAR FOTO DE PERFIL----------    -->
                            <div class="modal" tabindex="-1" id="modal_cargar_foto">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header bg-success">
                                                    <h5 class="modal-title ">AGREGAR UNA FOTO DE PERFIL</h5> 
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                  <form action="../acc/acc_guardar_foto.php?docente_id=<?php echo $_SESSION["docente_id"] ?>" method="POST" enctype="multipart/form-data">

                                                    <label for="foto"><h2 style="color:green">Elegir una foto</h2></label>
                                                    <br>
                                                    <input type="file" name="foto" accept="image/*">
                                                    <br>
                                                    <input type="submit" value="Subir foto">
                                                
                                                  </form>

                                                </div>
                                                <div class="modal-footer">

                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                              
                                                </div>
                                            </div>
                                            </div>
                            </div>

  <!-- Bootstrap JS -->

  
</script>
</body>
</html>
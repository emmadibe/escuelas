<?php

    if(isset($_GET["INFORMACION"])){ //Cómo a la variable INFORMACION la envío siempre vía url, es vía GET.

        $info = $_GET["INFORMACION"];

        switch ($info){

            case "NO_COMPLETO";

?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            <strong>UPSSS</strong> Debés completar el formulario primero, pal.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>

<?php

            break;

            case "ERROR_GUARDAR_CURSO";

?>

            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                <strong>UPSSS</strong> No se pudieron guardar los datos del curso, pal.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

<?php

            break;

            case "EXITO_GUARDAR_CURSO";

?>

            <div class="alert alert-success alert-dismissible fade show" role="alert">

                <strong>BIEN!</strong> Los datos del curso pudieron ser guardados correctamente.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

<?php

            break;

            case "!ISSET_ALUMNO";

?>

            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                <strong>UPSSS</strong> No seleccionaste ningún nombre para ningún alumno yet, pal.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

<?php

            break;

            case "ISSET_ALUMNO";

?>

            <div class="alert alert-success alert-dismissible fade show" role="alert">

                <strong>BIEN!</strong> El nombre del alumno fue guardado correctamente.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

<?php    

        }

    }

?>
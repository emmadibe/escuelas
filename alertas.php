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

            case "YA_EXISTE";

?>

        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            <strong>UPSSS</strong> El nombre del curso ya existe, pal. <br>
            <strong>Lo siento.</strong> El nombre del curso es utilizado como id, por lo que no puede repetirse.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>


<?php

            break;

            case "ERROR_AUTORIZACION";

?>

                <div class="alert alert-danger alert-dismissible fade show" role="alert">

                    <strong>UPSSS</strong> El usuario y/o contraseña son incorrectos. <br>
                    <strong>Lo siento.</strong> Intente nuevamente o creese un usuario nuevo.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>   
                    </button>

                </div>

<?php

            break;

            case "NO_DOCENTE";

?>

                <div class="alert alert-danger" role="alert">

                     Falta elegir el usuario y/contraseña!

                </div>

<?php

            break;

            case "DOCENTE_FRACASO";

?>

                <div class="alert alert-danger" role="alert">

                     No se pudo crear el usuario!

                </div>

<?php

            break;

            case "DOCENTE_EXITO";

?>

                <div class="alert alert-success alert-dismissible fade show" role="alert">

                    <strong>BIEN!</strong> El usuario fue creado con éxito. Usted ya puede iniciar sesión.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

<?php

            break;

            case "ACTUALIZADO";

?>

                <div class="alert alert-success alert-dismissible fade show" role="alert">

                    <strong>BIEN!</strong> La nota fue guardada con éxito.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

<?php

            break;

            case "NO_ACTUALIZADO";

?>

                <div class="alert alert-danger" role="alert">

                    No se pudo agregar la nota!

                </div>


<?php

            break;

            case "BORRADO_EXITO";

?>

                <div class="alert alert-success alert-dismissible fade show" role="alert">

                    <strong>BIEN!</strong> El curso fue borrado con éxito.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

<?

            break;

            case "BORRADO_FRACASO";

?>

                <div class="alert alert-danger" role="alert">

                    No se pudo borrar el curso!

                </div>


<?php

            break;

            case "EDITADO_CURSO_EXITO";

?>

                <div class="alert alert-success alert-dismissible fade show" role="alert">

                <strong>BIEN!</strong> El curso fue editado con éxito.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                </div>            

<?php

            break;

            case "EDITADO_CURSO_FRACASO";

?>

                <div class="alert alert-danger" role="alert">

                    No se pudo editar el curso!

                </div>

<?php

            break;

        }

    }

?>
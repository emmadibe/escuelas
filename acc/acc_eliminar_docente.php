<?php

    include "../conexion.php";

    //Me traigo las variables docente_id y curso que me traje vía url. Las necesito para decirle al programa qué datos quiero que me borre.
    $docente_id = $_GET["docente_id"];

    $sql = "DELETE FROM docentes WHERE docente_id = ".$docente_id.""; //Borrame todos los datos de todos los campos de la tabla docentes en donde el campo docente_id sea igual a la variable docente_id. Esta aclaración la hago para que el programa me borre al docente que yo quiero.
    $res = mysqli_query($link, $sql);

    if($res){

        header("location: ../frm/frm_cursos.php?INFORMACION=BORRADO_EXITO"); //Si existe $res, lo cual quiere decir que el curso se borró exitosamente, me redirige automáticamente a frm_cursos.php con el valor BORRAR_EXITO en la variable INFORMACION. Así, saltará una alerta que aclare que el curso fue borrado con éxito

    }else{

        header("location: ../frm/frm_cursos.php?INFORMACION=BORRADO_FRACASO"); //En cambio, si no existe $res, lo cual significa que no se pudo borrar el curso, me reedirigirá automáticamente a frm_cursos, pero con BORRADO_FRACASO como valor de INFORMACION. Eso hará que salte una alerta en rojo, definida en alertas.php, donde advertirá al usuario que no se pudo borrar el curso. 

    }

?>
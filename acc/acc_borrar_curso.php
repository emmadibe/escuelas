<?php

    include "../conexion.php";

    //Me traigo las variables docente_id y curso que me traje vía url. Las necesito para decirle al programa qué datos quiero que me borre.
    $docente_id = $_GET["docente_id"];
    $curso = $_GET["curso"];

    $sql_traer = "SELECT * FROM cursos WHERE docente_id = ".$docente_id." AND curso = '".$curso."'";
    $res_traer = mysqli_query($link, $sql_traer);
    $mostrar_traer = mysqli_fetch_array($res_traer);
    $curso_id = $mostrar_traer["curso_id"]; //Me traigo el campo curso_id ya que no existen dos iguales. Es la mejor forma de que el programa sepa cuál dato borrarme.

    $sql = "DELETE FROM cursos WHERE curso_id =".$curso_id." AND docente_id = ".$docente_id.""; //Borrame todos los datos de todos los campos de la tabla cursos en donde el campo curso sea igual a la variable curso y en donde el campo docente_id sea igual a la variable docente_id. Estas claraciones las hago para que el programa me borre el curso que yo quiero que pertenecen a su docente específico.
    $res = mysqli_query($link, $sql);

    if($res){

        header("location: ../frm/frm_cursos.php?INFORMACION=BORRADO_EXITO"); //Si existe $res, lo cual quiere decir que el curso se borró exitosamente, me redirige automáticamente a frm_cursos.php con el valor BORRAR_EXITO en la variable INFORMACION. Así, saltará una alerta que aclare que el curso fue borrado con éxito

    }else{

        header("location: ../frm/frm_cursos.php?INFORMACION=BORRADO_FRACASO"); //En cambio, si no existe $res, lo cual significa que no se pudo borrar el curso, me reedirigirá automáticamente a frm_cursos, pero con BORRADO_FRACASO como valor de INFORMACION. Eso hará que salte una alerta en rojo, definida en alertas.php, donde advertirá al usuario que no se pudo borrar el curso. 

    }

?>
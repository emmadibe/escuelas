<?php

    include "../conexion.php";

    SESSION_START();

    $docente_id = $_SESSION["docente_id"];
    $curso = $_GET["curso"];
    $curso_id = $_GET["curso_id"];
    $fila = $_POST["fila"];

    $sql = "DELETE FROM alumnos WHERE curso = '".$curso."' AND curso_id = ".$curso_id." AND numero = ".$fila." AND docente_id = ".$docente_id.""; //Borrame todos los datos de todos los campos de la tabla docentes en donde el campo docente_id sea igual a la variable docente_id. Esta aclaración la hago para que el programa me borre al docente que yo quiero.
    $res = mysqli_query($link, $sql);

    if($res){

        header("location: ../frm/frm_ver_notas_2do_intento.php?INFORMACION=BORRADOALUMNO_EXITO&curso=$curso&curso_id=$curso_id&numero=$fila"); //Me llevo todas esas variables porque son necesarias para que la página se actualice con normalidad. Por ejemplo, para en la tabla se muestren todos los nombres de los alumnos, debe existir la variable numero.

    }else{
        
        header("location: ../frm/frm_ver_notas_2do_intento.php?INFORMACION=BORRADOALUMNO_FRACASO&curso=$curso&curso_id=$curso_id&numero=$fila"); 

    }

?>
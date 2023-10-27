<?php

    include "../conexion.php";
    include "../functions.php";

    SESSION_START();

    $docente_id = $_SESSION["docente_id"];
    $curso = $_GET["curso"];
    $curso_id = $_GET["curso_id"];
    $fila = $_POST["fila"];

    $res = borrarDatosAlumno($curso, $curso_id, $fila, $docente_id); //La función borrarDatosAlumno() está definida en el archivo functions.php

    if($res){

        header("location: ../frm/frm_ver_notas_2do_intento.php?INFORMACION=BORRADOALUMNO_EXITO&curso=$curso&curso_id=$curso_id&numero=$fila"); //Me llevo todas esas variables porque son necesarias para que la página se actualice con normalidad. Por ejemplo, para en la tabla se muestren todos los nombres de los alumnos, debe existir la variable numero.

    }else{
        
        header("location: ../frm/frm_ver_notas_2do_intento.php?INFORMACION=BORRADOALUMNO_FRACASO&curso=$curso&curso_id=$curso_id&numero=$fila"); 

    }

?>
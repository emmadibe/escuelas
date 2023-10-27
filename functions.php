<?php

    include "conexion.php";

//////////////////////////////////////////// FUNCIÖN PARA ELIMINAR A UN ALUMNO DE MI BASE DE DATOS. LO USO EN EL ARCHIVO acc_eliminar_docente.php.
    function borrarDatosAlumno($curso, $curso_id, $fila, $docente_id) {

        include "conexion.php";

        $sql = "DELETE FROM alumnos WHERE curso = '".$curso."' AND curso_id = ".$curso_id." AND numero = ".$fila." AND docente_id = ".$docente_id.""; //Borrame todos los datos de todos los campos de la tabla docentes en donde el campo docente_id sea igual a la variable docente_id. Esta aclaración la hago para que el programa me borre al docente que yo quiero.
        
        $res = mysqli_query($link, $sql);

        return $res;

    }

?>
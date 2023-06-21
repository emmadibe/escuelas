<?php

    SESSION_START();
    $colegio = $_POST["colegio"];
    $curso = $_POST["curso"];
    $cant_alumnos = $_POST["cant_alumnos"];
    $cant_notas = $_POST["cant_notas"];
    $color_fondo = $_POST["color_fondo"];
    $color_click = $_POST["color_click"];
    $color_barra = $_POST["color_barra"];
    $docente_id = $_SESSION["docente_id"];
    $curso_id = $_GET["curso_id"];

    include "../conexion.php";

    $sql = "UPDATE cursos SET colegio = '".$colegio."',
                                curso = '".$curso."',
                                cant_alumnos = ".$cant_alumnos.",
                                cant_notas = ".$cant_notas.",
                                color_fondo = '".$color_fondo."',
                                color_click = '".$color_click."',
                                color_barra = '".$color_barra."'

                            WHERE docente_id = ".$docente_id." AND curso_id = ".$curso_id; //Así, el programa sabe qué curso de qué docente_id actualizar. Ya que el curso_id y el docente_id nunca jamás se van a repetir.

    $res = mysqli_query($link, $sql);

    if($res){

        header("location: ../frm/frm_cursos.php?INFORMACION=EDITADO_CURSO_EXITO");

    }else{

        header("location: ../frm/frm_cursos.php?INFORMACION=EDITADO_CURSO_FRACASO");

    }


?>
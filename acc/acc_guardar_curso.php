<?php

    if(isset($_GET["colegio"]) AND
       isset ($_GET["curso"]) AND
       isset($_GET["cant_alumnos"]) AND
       isset($_GET["color_fondo"]) AND
       isset($_GET["color_tabla"]) AND
       isset($_GET["color_click"])){

            $colegio = $_GET["colegio"];
            $curso = $_GET["curso"];
            $cant_alumnos = $_GET["cant_alumnos"];
            $color_fondo = $_GET["color_fondo"];
            $color_tabla = $_GET["color_tabla"];
            $color_click = $_GET["color_click"];

            include "../conexion.php"; //Con el código dentro de este archivo me conecto al servidor de mi base de datos y a mi base de datos que es escuelas_db

            $sql = "INSERT INTO cursos (colegio, 
                                        curso,
                                        cant_alumnos,
                                        color_fondo,
                                        color_tabla,
                                        color_click)

                                    VALUES('".$colegio."',
                                        '".$curso."',
                                        ".$cant_alumnos.",
                                        '".$color_fondo."',
                                        '".$color_tabla."',
                                        '".$color_click."')";

            $res = mysqli_query($link, $sql); //El link está dentro del archivo conexion.php incluido.

            if ($res){

                header ("location:../frm/frm_notas.php?INFORMACION=EXITO_GUARDAR_CURSO&curso=$curso");

            }else{

                header ("location:../frm/frm_cursos.php?INFORMACION=ERROR_GUARDAR_CURSO");

            }

       }else{

            header("../frm/frm_cursos.php?INFORMACION=NO_COMPLETO");

       }

?>
<?php

    if(isset($_GET["colegio"]) AND
       isset ($_GET["curso"]) AND
       isset($_GET["cant_alumnos"]) AND
       isset($_GET["color_fondo"]) AND
       isset($_GET["color_tabla"]) AND
       isset($_GET["color_click"])){

            SESSION_START();

            $colegio = $_GET["colegio"];
            $curso = $_GET["curso"];
            $cant_alumnos = $_GET["cant_alumnos"];
            $color_fondo = $_GET["color_fondo"];
            $color_tabla = $_GET["color_tabla"];
            $color_click = $_GET["color_click"];
            $docente_id = $_SESSION["docente_id"]; //Me traigo esta variable desde sesión. Es necesario para identificar qué curso le debo asignar a cada docente.
            $cant_notas = $_GET["cant_notas"];

            include "../conexion.php"; //Con el código dentro de este archivo me conecto al servidor de mi base de datos y a mi base de datos que es 
            
            $sql_1 = "SELECT * FROM cursos WHERE docente_id =".$docente_id;
            $res_1 = mysqli_query($link, $sql_1);
            $mostrar_1 = mysqli_fetch_array($res_1);

            if($mostrar_1["curso"] != $curso){ //Hago esto porque el nombre del curso me sirve como id. No puede repetirse, por ende. 

                        $sql = "INSERT INTO cursos (colegio, 
                                                    curso,
                                                    cant_alumnos,
                                                    color_fondo,
                                                    color_tabla,
                                                    color_click,
                                                    docente_id,
                                                    cant_notas)

                                                VALUES('".$colegio."',
                                                    '".$curso."',
                                                    ".$cant_alumnos.",
                                                    '".$color_fondo."',
                                                    '".$color_tabla."',
                                                    '".$color_click."',
                                                    ".$docente_id.",
                                                    ".$cant_notas.")";

                        $res = mysqli_query($link, $sql); //El link está dentro del archivo conexion.php incluido.

                        if ($res){

                            header ("location:../frm/frm_notas.php?INFORMACION=EXITO_GUARDAR_CURSO&curso=$curso");

                        }else{

                            header ("location:../frm/frm_cursos.php?INFORMACION=ERROR_GUARDAR_CURSO");

                        }

            }else{

                header("location:../frm/frm_cursos.php?INFORMACION=YA_EXISTE");

            }

       }else{

            header("../frm/frm_cursos.php?INFORMACION=NO_COMPLETO");

       }

?>
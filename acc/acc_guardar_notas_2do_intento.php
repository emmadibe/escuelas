<?php

    //EN ESTE SEGUNDO MODO DE HACER EL PROYECTO NO NECESITO COLUMNAS.

    if(isset($_POST["nombre"]) AND 
        isset($_GET["numero"]) AND 
        isset($_GET["curso"])){

            SESSION_START();

        $nombre = $_POST["nombre"];
        $numero = $_GET["numero"];
        $curso = $_GET["curso"]; //Me tuve que traer la variable curso vía GET porque sino, una vez que vuelva a fr_notas, no voy a tener esa variable y el programa me va a tirar un UNDEFINIDED VARIABLE.
        $docente_id = $_SESSION["docente_id"];

        include "../conexion.php";

        $sql = "INSERT INTO alumnos (nombre,
                                     numero,
                                     curso,
                                     docente_id) 
                            VALUES('".$nombre."',
                                    ".$numero.",
                                    '".$curso."',
                                    ".$docente_id.")";                                  
        $res = mysqli_query($link, $sql);

        if($res){

             header("location:../frm/frm_ver_notas_2do_intento.php?INFORMACION=ISSET_ALUMNO&curso=$curso&numero=$numero");

        }else{

            header("location:../frm/frm_ver_notas_2do_intento.php?INFORMACION=!ISSET_ALUMNO&curso=$curso");

        }

    }else if(isset($_GET["fila"])){

            $fila = $_GET["fila"];
            $curso = $_GET["curso"];
            $nota=$_POST["nota"];

          
            

            include "../conexion.php";

            $sql_traer = "SELECT * FROM alumnos WHERE numero = ".$fila;
            $res_traer = mysqli_query($link, $sql_traer);
            $mostrar_traer = mysqli_fetch_array($res_traer);
            $nota_anterior = $mostrar_traer["nota_array"];

            $sql_cantnotas = "SELECT * FROM cursos WHERE curso = '".$curso."'";
            $res_cantnotas = mysqli_query($link, $sql_cantnotas);
            $mostrar_cantnotas = mysqli_fetch_array($res_cantnotas);
            $total_notas = $mostrar_cantnotas["cant_notas"];
            $Notas = array();

            if (!isset($nota_anterior)){

                $Notas = array();

            }           

            $sql_act = "UPDATE alumnos SET nota_array=".$Notas."
                                        WHERE numero=".$fila;
            $res_act = mysqli_query($link, $sql_act);

            $sql_trae = "SELECT * FROM alumnos WHERE numero = ".$fila;
            $res_trae = mysqli_query($link, $sql_trae);
            $mostrar_trae = mysqli_fetch_array($res_trae);

            if($res_trae){

                header("location:../frm/frm_ver_notas_2do_intento.php?INFORMACION=ISSET_ALUMNO&curso=$curso&numero=$fila");
   
           }else{
   
               header("location:../frm/frm_ver_notas_2do_intento.php?INFORMACION=NO_ACTUALIZO&curso=$curso");
   
           }

        }else{


        header("location:../frm/frm_ver_notas_2do_intento.php?INFORMACION=NADA&curso=$curso");

    }

?>
<?php

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

             header("location:../frm/frm_ver_notas_2do_inento.php?INFORMACION=ISSET_ALUMNO&curso=$curso&numero=$numero&columna=$columna");  //Variables que deben existir para que no me tire un error.

        }else{

            header("location:../frm/frm_notas.php?INFORMACION=!ISSET_ALUMNO&curso=$curso");

        }

    }else if(isset($_GET["fila"])){

            $fila = $_GET["fila"];
            $columna = $_GET["columna"];
            $curso = $_GET["curso"];
            $nota=$_POST["nota"];

            include "../conexion.php";

            $sql_act = "UPDATE alumnos SET nota_$columna=".$nota.", columna_$columna=".$columna." 
                                        WHERE numero=".$fila;
            $res_act = mysqli_query($link, $sql_act);

            $sql_trae = "SELECT * FROM alumnos WHERE numero = ".$fila;
            $res_trae = mysqli_query($link, $sql_trae);
            $mostrar_trae = mysqli_fetch_array($res_trae);

            if($res_trae){

                header("location:../frm/frm_notas.php?INFORMACION=ISSET_ALUMNO&curso=$curso&numero=$fila&columna=$columna");
   
           }else{
   
               header("location:../frm/frm_notas.php?INFORMACION=NO_ACTUALIZO&curso=$curso");
   
           }

        }else{


        header("location:../frm/frm_notas.php?INFORMACION=NADA&curso=$curso");

    }

?>
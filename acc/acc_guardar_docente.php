<?php

    include "../conexion.php";

    if(!isset($_POST["usuario"]) AND
        (!isset($_POST["pass"]))){

            header("location:../frm/frm_crear_docente.php?INFORMACION=NO_DOCENTE");

        }else{

            $usuario = $_POST["usuario"];
            $pass = $_POST["pass"];

            $sql = "INSERT INTO docentes (nombre,
                                            contraseña,
                                            rol_id)
                                            
                                        VALUES('".$usuario."',
                                                '".$pass."',
                                                2)";

        //Al rol_id le asigno 2 (usuario común) ya que los administradores (rol_id = 1) suelen crearse desde la base de datos misma.

            $res = mysqli_query($link, $sql);
            
            if($res){

                header("location:../index.php?INFORMACION=DOCENTE_EXITO");

            }else{

                header("location:../frm/frm_crear_docente.php?INFORMACION=DOCENTE_FRACASO");

            }

        }


?>
<?php

 SESSION_START();

 if(isset($_POST["usuario"]) AND
    isset($_POST["pass"])){

        $usuario = $_POST["usuario"];
        $pass = $_POST["pass"];

        include "../conexion.php";

        $sql = "SELECT * FROM docentes WHERE nombre =  '".$usuario."' AND contraseña = '".$pass."'";
        $res = mysqli_query($link, $sql);
        $datos = mysqli_fetch_array($res);

        if(mysqli_affected_rows($link)){ //el affected es una consulta que permite ver si hay una coincidencia. Si marca 1, hay coincidencia ( o sea, el usuario fue bien ingresado); sino, 0. //Si encontraste alguna fila (lo cual quiere decir que el usuario y la contraseña ingresados son correctos) hacé lo siguiente:

            $_SESSION["nombre"] = $usuario;
            $_SESSION["docente_id"] = $datos["docente_id"];
            $_SESION["rol_id"] = $datos["rol_id"];

            header("location:../frm/frm_cursos.php");

        }else{

            header("location:../index.php?INFORMACION=ERROR_AUTORIZACION");

        }

    }

?>

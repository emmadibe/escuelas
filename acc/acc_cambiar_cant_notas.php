<?php

    if (isset($_POST["cant_notas"]) AND isset($_GET["curso_id"])){

        $curso_id = $_GET["curso_id"];
        $cant_notas = $_POST["cant_notas"];
        $curso = $_GET["curso"];

        $cant_notas_final = $cant_notas + 1;  //Viene un número menor al ingresado por el usuario.
        
        include "../conexion.php";

        $sql = "UPDATE cursos SET cant_notas = ? WHERE curso_id = ?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $cant_notas_final, $curso_id);
        mysqli_stmt_execute($stmt);

        if($stmt){

            header("location: ../frm/frm_ver_notas_2do_intento.php?INFORMACION=EDITADO_CURSO_EXITO?columna=x&numero=1&curso=$curso&curso_id=$curso_id");
    
        }else{
    
            header("location: ../frm/frm_ver_notas_2do_intento.php?INFORMACION=EDITADO_CURSO_FRACASO?columna=x&numero=1&curso=$curso&curso_id=$curso_id");
    
        }

    }



?>
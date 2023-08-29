<?php
if(isset($_GET["nombre"]) && isset($_GET["contraseña"]) && isset($_GET["docente_id"]) && isset($_GET["rol_id"])) { //Estoy validando que existan, vía función isset(), las variables nombre, contraseña, rol_id y docente_id. Pues, necesito esas variables para actualizar los datos de mi docente. 
    $nombre = $_GET["nombre"];
    $contraseña = $_GET["contraseña"];
    $rol_id = $_GET["rol_id"];
    $docente_id = $_GET["docente_id"];

    include "../conexion.php";

    $sql = "UPDATE docentes SET nombre='$nombre', contraseña='$contraseña', rol_id=$rol_id WHERE docente_id=$docente_id";

    $res = mysqli_query($link, $sql);

    if($res) { //Valido que se hayan actualizado los datos.
        $respuesta = true;
    } else {
        $respuesta = false;
    }

    echo json_encode($respuesta);
}


?>

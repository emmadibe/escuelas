<?php 

    if(isset($_GET["docente_id"])){

        $docente_id = $_GET["docente_id"];

        include "../conexion.php";

        $sql = "SELECT * FROM docentes WHERE docente_id = ".$docente_id;
        $res = mysqli_query($link, $sql);
        $respuesta = mysqli_fetch_array($res);
        echo json_encode ($respuesta);


    }

?>
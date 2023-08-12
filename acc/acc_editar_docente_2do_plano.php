<?php

            $nombre = $_GET["nombre"];
            $contraseña = $_GET["contraseña"];
            $rol_id = $_GET["rol_id"];
            $docente_id = $_GET["docente_id"];

            include "../conexion.php";

            $sql = "UPDATE docentes SET nombre='".$nombre."',
                                        contraseña='".$contraseña."',
                                        rol_id=".$rol_id.",

                                    WHERE docente_id = ".$docente_id;
            //Actualizo (consulta UPDATE) de la tabla docentes los campos nombre, contrseña y rol_id, a los cuales les asigno los valores de las variables $nombre, $contraseña y $rol_id respectivamente. Actualizo solo aquellos datos del usuario cuyo campo docente_id es igual al valor de la variable $docente_id.
                

            $res = mysqli_query($link, $sql);

            $respuesta = $res;//No utilizo la función mysqli_fetch_array(); porque la consulta UPDATE no te devuelve un array, sino que te devuelve un booleano: pude o no pude (editarlo).
            echo json_encode($respuesta);//Devuelvo a .get en frm_ver_todos_docentes.php


?>
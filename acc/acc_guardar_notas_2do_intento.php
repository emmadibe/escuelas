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

    }else if(isset($_GET["fila"])){ //Lo que viene es para actualizar el campo nota_array de la tabla alumnos. 
            //Variable que me traigo de frm_ver_notas_2do_intento.php:
            $fila = $_GET["fila"];
            $curso = $_GET["curso"];
            $nota=$_POST["nota"];

            //Me conecto ami base de datos:
            include "../conexion.php";

            //Me traigo el campo nota_array de la tabla alumnos de la base de datos escuelas para poder utilizarlo:
            $sql_traer = "SELECT nota_array FROM alumnos WHERE numero = ".$fila; //Traeme el campo nota_array de la tabla alumnos en donde el campo numero sea igual al valor de la variable $fila.
            $res_traer = mysqli_query($link, $sql_traer);
            $mostrar_traer = mysqli_fetch_array($res_traer);

            $Notas_agregadas = array();

            if ($mostrar_traer['nota_array'] == NULL){ //El código entre corchetes se ejecutará si el campo nota_array de la tabla alumnos de mi base de datos escuelas es NULL; es decir, si aún no le he agregado ningún valor.             
                    //Yo lo que quiero es almacenar en un campo (nota_array) las notas de mi alumno. O sea, todas las notas, todos los números, deben estar en un campo. Para eo, utilizar un ARRAY es lo mejor ya que me permite almacenar distintos valores. Cada valor tendrá una posición en mi array. Acordate que la primera posición en todo array es 0.
                    $Notas = array($nota); //Inicializo el array con un único valor. Ese valor es el valor de la variable $nota.
                    $Notas_envio = serialize($Notas); //Serializo el array. Eso es necesario para poder guardarla en mi base de datos. Sino, no se puede. 

                    $sql_act = "UPDATE alumnos SET nota_array='".$Notas_envio."' 
                                                WHERE numero=".$fila; //Ahora sí, actualizo (UPDATE) mi tabla alumnos guardando el valor de mi array serializado $Notas_envio en el campo nota_array.
                    $res_act = mysqli_query($link, $sql_act);

                    header("location:../frm/frm_ver_notas_2do_intento.php?curso=$curso&numero=$fila");
                    

                     
                    
            }else{ //En cambio, si el campo nota_array ya tenía un valor lo que debo hacer es seguir agregándole valores.

                    $mostrar_deserializado = unserialize($mostrar_traer['nota_array']); //Me traigo, primero, los valores que ya tengo en el campo nota_array deserializado. Eso es necesario para poder agregarle valores.

                    $Notas_agregadas[] = array($mostrar_deserializado, $nota); //Inicializo otro array llamado $Notas_agregadas a la cual le voy a poner los valores de $mostrar_deserializado (tiene los valores que el campo nota_array ya tenía) y de $nota.

                    $Notas_agregadas_serializadas = serialize($Notas_agregadas); //Serializo el array, lo cual es necesario para poder guardar sus valores en mi base de datos.

                    $sql_act = "UPDATE alumnos SET nota_array='".$Notas_agregadas_serializadas."'
                                                    WHERE numero=".$fila; //Ahora sí: actualizo mi field nota_array.
                    $res_act = mysqli_query($link, $sql_act);

                    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                    // Mostremos el elemento del array en pantalla:
                                    //$sql_mostrar1 = "SELECT * FROM alumnos WHERE numero = ".$fila;
                                    //$res_mostrar1 = mysqli_query($link, $sql_mostrar1);
                                    //$muestrate_mostrar1 = mysqli_fetch_array($res_mostrar1);
                                // $Notas_deserializado = unserialize($muestrate_mostrar1['nota_array']);
                                    // echo implode(', ', $Notas_deserializado); //Así, si la nota es 3, se verá un 3 en pantalla.
                    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                    if($res_act){

                        header("location:../frm/frm_ver_notas_2do_intento.php?INFORMACION=ACTUALIZADO&curso=$curso&numero=$fila");

                    }else{

                        header("location:../frm/frm_ver_notas_2do_intento.php?INFORMACION=NO_ACTUALIZADO&curso=$curso&numero=$fila");

                    }

            }

        }else{


            //header("location:../frm/frm_ver_notas_2do_intento.php?INFORMACION=NADA&curso=$curso");

    }

?>
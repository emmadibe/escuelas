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
        $curso_id = $_GET["curso_id"];

        include "../conexion.php";

        $sql = "INSERT INTO alumnos (nombre,
                                     numero,
                                     curso,
                                     docente_id,
                                     curso_id) 
                            VALUES('".$nombre."',
                                    ".$numero.",
                                    '".$curso."',
                                    ".$docente_id.",
                                    ".$curso_id.")";                                  
        $res = mysqli_query($link, $sql);

        if($res){

             header("location:../frm/frm_ver_notas_2do_intento.php?INFORMACION=ISSET_ALUMNO&curso=$curso&numero=$numero&curso_id=$curso_id");

        }else{

            header("location:../frm/frm_ver_notas_2do_intento.php?INFORMACION=!ISSET_ALUMNO&curso=$curso&curso_id=$curso_id");

        }

    }else if(isset($_GET["fila"])){ //Lo que viene es para actualizar el campo nota_array de la tabla alumnos. 
            //Variable que me traigo de frm_ver_notas_2do_intento.php:
            $fila = $_GET["fila"];
            $curso = $_GET["curso"];
            $nota=$_POST["nota"];
            $curso_id=$_GET["curso_id"]; //Es necesario el curso_id para que en pantalla luego se impriman las notas que corresponden a ESA fila y a ESE curso_id. Sino, se pueden imprimir en pantalla todas las notas que correspondan a ESA fila, pero a cualquier curso.

            SESSION_START();

            //Me conecto a mi base de datos:
            include "../conexion.php";

            //Me traigo el campo nota_array de la tabla alumnos de la base de datos escuelas para poder utilizarlo:
            $sql_traer = "SELECT nota_array FROM alumnos WHERE curso_id = $curso_id && numero = ".$fila; //Traeme el campo nota_array de la tabla alumnos en donde el campo numero sea igual al valor de la variable $fila.
            $res_traer = mysqli_query($link, $sql_traer);
            $mostrar_traer = mysqli_fetch_array($res_traer);

            $Notas_agregadas = array();

            if ($mostrar_traer['nota_array'] == NULL){ //El código entre corchetes se ejecutará si el campo nota_array de la tabla alumnos de mi base de datos escuelas es NULL; es decir, si aún no le he agregado ningún valor.             
                    //Yo lo que quiero es almacenar en un campo (nota_array) las notas de mi alumno. O sea, todas las notas, todos los números, deben estar en un campo. Para eo, utilizar un ARRAY es lo mejor ya que me permite almacenar distintos valores. Cada valor tendrá una posición en mi array. Acordate que la primera posición en todo array es 0.
                    $Notas = array($nota); //Inicializo el array con un único valor. Ese valor es el valor de la variable $nota.
                    $Notas_envio = serialize($Notas); //Serializo el array. Eso es necesario para poder guardarla en mi base de datos. Sino, no se puede. 

                    $sql_act = "UPDATE alumnos SET nota_array='".$Notas_envio."' 
                                                WHERE numero=".$fila." && curso_id=".$curso_id."" ; //Ahora sí, actualizo (UPDATE) mi tabla alumnos guardando el valor de mi array serializado $Notas_envio en el campo nota_array.
                    $res_act = mysqli_query($link, $sql_act);

//////////////////////////////////////////////////////////////////// GUARDAR PROMEDIO ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    $sql_1 = "SELECT * FROM alumnos 
                    WHERE curso = '".$curso."' AND docente_id = ".$_SESSION['docente_id'];
                    $res_1 = mysqli_query($link, $sql_1);
                    $mostrar_1 = mysqli_fetch_array($res_1);
                    //////////Primero serializar los valores del array antes de trabajar con ellos:
                    $nota_array = unserialize($mostrar_1['nota_array']);
                    //Ahora, debo sumar los valores almacenados en el array $nota_array. Para ello, utilizaré el bucle foreach. En cada ciclo, la variable $valor almacenará un elemento del array $nota_array y se sumará  a la variable $suma.- 
                    $suma = 0;
                    foreach ($nota_array as $valor){

                        $suma += $valor;

                    }
                    //Ahora, debo calcular la longitud del array. Para ello, utilizo la función count(), la cual me retorna un int que indica la longitud del array que le paso como parámetro. 
                    $longitud = count($nota_array);
                    //Calculo el promedio: 
                    $promedio = $suma / $longitud;
                    //Guardo el valor de la variable promedio en la columna promedio de la tabla alumnos de la base de datos escuela_db:
                    $sql_promedio = "UPDATE alumnos SET promedio = '".$promedio."' WHERE numero = ".$fila." && curso_id = ".$curso_id;
                    $res_promedio = mysqli_query($link, $sql_promedio);
                    
/////////////////////////////////////////////////////////////////// FIN DE CALCULAR Y GUARDAR PROMEDIO //////////////////////////////////////////////////////////////////////////////////////////
                    header("location:../frm/frm_ver_notas_2do_intento.php?curso=$curso&numero=$fila&curso_id=$curso_id");
                                      
            }else{ //En cambio, si el campo nota_array ya tenía un valor lo que debo hacer es seguir agregándole valores.

                    $mostrar_deserial = unserialize($mostrar_traer['nota_array']); //Primero, me traigo los datos almacenados en un array y guardados en el campo 'nota_array' de la tabla alumnos. Esos datos debo deserializarlos con la función unserialize. Debo deserializarlos sí o sí para poder seguir agregándole valores al array. 

                    for($h = 0; $h <= count($mostrar_deserial); $h++){ //Con un bucle, le voy pasando los valores del array mostrar_deserial a $mostrar_deserializado2. Obviamente, el bucle se detiene cuando llegamos al final del array. Gracias a la función count() sé cuál es la longitud del array; pues, count es una función que me retorna un int que indica la longitud del array. 

                        $mostrar_deserializado2[$h] = $mostrar_deserial[$h]; //Me traigo, primero, los valores que ya tengo en el campo nota_array deserializado. Eso es necesario para poder agregarle valores.

                    }

                    $mostrar_deserializado2[count($mostrar_deserializado2) - 1] = $nota; //Ahora, solo debo agregar el nuevo dato. Debo agregarlo, obviamente, en el elemento que le sigue al último dato almacenado. Sé que el último dato almacenado coincidirá con la longitud del array. 
                    $Notas_agregadas_serializadas = serialize($mostrar_deserializado2); //Serializo el array, lo cual es necesario para poder guardar sus valores en mi base de datos.

                    $sql_act = "UPDATE alumnos SET nota_array='".$Notas_agregadas_serializadas."'
                                                    WHERE numero=".$fila." && curso_id=".$curso_id.""; //Ahora sí: actualizo mi field nota_array.
                    $res_act = mysqli_query($link, $sql_act);

//////////////////////////////////////////////////////////////////// GUARDAR PROMEDIO ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                    $sql_1 = "SELECT * FROM alumnos 
                                        WHERE curso = '".$curso."' AND docente_id = ".$_SESSION['docente_id'];
                    $res_1 = mysqli_query($link, $sql_1);
                    $mostrar_1 = mysqli_fetch_array($res_1);
                    //////////Primero serializar los valores del array antes de trabajar con ellos:
                    $nota_array = unserialize($mostrar_1['nota_array']);
                    //Ahora, debo sumar los valores almacenados en el array $nota_array. Para ello, utilizaré el bucle foreach. En cada ciclo, la variable $valor almacenará un elemento del array $nota_array y se sumará  a la variable $suma.- 
                    $suma = 0;
                    foreach ($nota_array as $valor){

                        $suma += $valor;

                    }
                    //Ahora, debo calcular la longitud del array. Para ello, utilizo la función count(), la cual me retorna un int que indica la longitud del array que le paso como parámetro. 
                    $longitud = count($nota_array);
                    //Calculo el promedio: 
                    $promedio = $suma / $longitud;
                    //Guardo el valor de la variable promedio en la columna promedio de la tabla alumnos de la base de datos escuela_db:
                    $sql_promedio = "UPDATE alumnos SET promedio = '".$promedio."' WHERE numero = ".$fila." && curso_id = ".$curso_id;
                    $res_promedio = mysqli_query($link, $sql_promedio);

///////////////////////////////////////////////////////////////////FIN DE CALCULAR Y GUARDAR PROMEDIO //////////////////////////////////////////////////////////////////////////////////////////

                    if($res_act){

                        header("location:../frm/frm_ver_notas_2do_intento.php?INFORMACION=ACTUALIZADO&curso=$curso&numero=$fila&curso_id=$curso_id");

                    }else{

                        header("location:../frm/frm_ver_notas_2do_intento.php?INFORMACION=NO_ACTUALIZADO&curso=$curso&numero=$fila&curso_id=$curso_id");

                    }

            }

        }else{


            //header("location:../frm/frm_ver_notas_2do_intento.php?INFORMACION=NADA&curso=$curso");

    }

?>
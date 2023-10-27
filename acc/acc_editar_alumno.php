<?php

    SESSION_START();

    if(isset($_POST["fila"]) AND 
        isset($_POST["numNota"]) AND
        isset($_POST["valNota"]) AND
        isset($_GET["curso_id"]))
    {

        $fila = $_POST["fila"];
        $numNota = $_POST["numNota"];
        $valNota = $_POST["valNota"];
        $curso_id = $_GET["curso_id"];
        $curso = $_GET["curso"];
        $docente_id = $_SESSION["docente_id"];

        include "../conexion.php";
        
        //Me traigo el campo nota_array de la tabla alumnos de la base de datos escuelas para poder utilizarlo:
        $sql_traer = "SELECT nota_array FROM alumnos WHERE curso_id = $curso_id && numero = ".$fila;  //Traeme el campo nota_array de la tabla alumnos en donde el campo numero sea igual al valor de la variable $fila.
        $res_traer = mysqli_query($link, $sql_traer);
        $mostrar_traer = mysqli_fetch_array($res_traer);

        $Notas_agregadas = array();

        if ($mostrar_traer == NULL)
        {

            $Notas[$numNota - 1] = array($valNota); //Inicializo el array con un único valor. Ese valor es el valor de la variable $valNota.

            $Notas_envio = serialize($Notas); //Serializo el array. Eso es necesario para poder guardarla en mi base de datos. Sino, no se puede. 

            $sql_act = "UPDATE alumnos SET nota_array='".$Notas_envio."' 
                                                WHERE numero=".$fila." && curso_id=".$curso_id."" ; //Ahora sí, actualizo (UPDATE) mi tabla alumnos guardando el valor de mi array serializado $Notas_envio en el campo nota_array.
            $res_act = mysqli_query($link, $sql_act);

            if($res_act)
            {

                header("location: ../frm/frm_ver_notas_2do_intento.php?INFORMACION=NUEVOExito&curso=$curso&curso_id=$curso_id&docente_id=$docente_id&numero=$numNota");

            }else{

                header("location: ../frm/frm_ver_notas_2do_intento.php?INFORMACION=EDITADO_CURSO_FRACASO&curso=$curso&curso_id=$curso_id&docente_id=$docente_id&numero=$numNota");

            }

        }else{
            
            $mostrar_deserial = unserialize($mostrar_traer['nota_array']); //Primero, me traigo los datos almacenados en un array y guardados en el campo 'nota_array' de la tabla alumnos. Esos datos debo deserializarlos con la función unserialize. Debo deserializarlos sí o sí para poder seguir agregándole valores al array o para editarlos. 

            for($h = 0; $h <= count($mostrar_deserial); $h++){ //Con un bucle, le voy pasando los valores del array mostrar_deserial a $mostrar_deserializado2. Obviamente, el bucle se detiene cuando llegamos al final del array. Gracias a la función count() sé cuál es la longitud del array; pues, count es una función que me retorna un int que indica la longitud del array. 

                $mostrar_deserializado2[$h] = $mostrar_deserial[$h]; //Me traigo, primero, los valores que ya tengo en el campo nota_array deserializado. Eso es necesario para poder agregarle valores o editarlos.

            }

            $mostrar_deserializado2[$numNota - 1] = $valNota; //Agrego el nuevo valor (valNota) en el índice del array correspondiente (numNota - 1). Le debo restar 1 porque todos los array inician en el índice 0. El usuario quiere cambiar, por ejemplo, la primera nota, pero esa sería el [0]

            $Notas_agregadas_serializadas = serialize($mostrar_deserializado2); //Serializo el array, lo cual es necesario para poder guardar sus valores en mi base de datos.

            $sql_editarAlumno = "UPDATE alumnos SET nota_array = '".$Notas_agregadas_serializadas."'
                                    WHERE docente_id = ".$_SESSION['docente_id']." AND curso_id = ".$curso_id." AND numero = ".$fila; //Así, el programa sabe qué alumno de qué qué curso de qué docente_id actualizar. Ya que el curso_id y el docente_id nunca jamás se van a repetir.

            $res_editarAlumno = mysqli_query($link, $sql_editarAlumno);

            if($res_editarAlumno)
            {

                header("location: ../frm/frm_ver_notas_2do_intento.php?INFORMACION=EDITADO_CURSO_EXITO&curso=$curso&curso_id=$curso_id&docente_id=$docente_id&numero=$numNota");

            }else{

                header("location: ../frm/frm_ver_notas_2do_intento.php?INFORMACION=EDITADO_CURSO_FRACASO&curso=$curso&curso_id=$curso_id&docente_id=$docente_id&numero=$numNota");

            }

        }


    }

?>
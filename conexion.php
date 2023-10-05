<?php
     $link=mysqli_connect("localhost", "root", ""); //Me conecto al servidor de mi base de datos.
     mysqli_select_db($link, "escuelas_db"); //Me conecto a mi base de datos que es escuelas_db

          if(isset($curso) AND isset($docente_id) ){ 
     ///////////Consulta para traerme todos los campos de la tabla alumnos en donde curso sea igual a $curso y el docente_id igual a $docente_id. Así, me traigo los campos de los alumnos del curso con el que trabajo y de ESE docente.
    //Si no hago el isset, y las variables no existen, me tira un error horrible.
               $sql_notas = "SELECT * FROM alumnos WHERE curso ='".$curso."' AND docente_id = ".$docente_id;
          //Me traigo todos los campos de la tabla alumnos en donde el campo curso sea igual a la variable curso. Eso es para traerme los datos de los alumnos del curso que me interesa. 
               $res_notas = mysqli_query($link, $sql_notas);
               $mostrar_notas = mysqli_fetch_array($res_notas);
               $notas = $mostrar_notas["nota_array"];
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////     
          
//////////////////////////////////////Consulta para traerme todos los campos de la tabla cursos en donde curso sea igual a $curso y docente_id igual a $docente_id

               $sql_curso = "SELECT * FROM cursos WHERE curso='".$curso."' && docente_id = ".$docente_id;
               $res_curso = mysqli_query($link, $sql_curso);
               $mostrar_curso = mysqli_fetch_array($res_curso);
               $alto = $mostrar_curso["cant_alumnos"];
               $curso_id = $mostrar_curso["curso_id"];

           
               if (!$res_curso) {
                    echo "Error al ejecutar la consulta: " . mysqli_error($link);
                    exit;
               }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

          }

     
/////////////////////////////////////// Consulta para conseguir todo los campos de la tabla docente en donde docente_id es igual a $docente_id.
          if(isset($docente_id)){
               $sql = "SELECT * FROM docentes WHERE docente_id = ?";
               $stmt = mysqli_prepare($link, $sql);
               mysqli_stmt_bind_param($stmt, "i", $docente_id);
               mysqli_stmt_execute($stmt);
               $res = mysqli_stmt_get_result($stmt);
               $mostrar_docente = mysqli_fetch_assoc($res);
          
////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////Consulta para conseguir todos los campos de la tabla cursos en donde el campo docente_id se igual a docente_id.

               $sql_curso2 = "SELECT * FROM cursos WHERE docente_id = ".$docente_id; //Traeme todos los datos de todos los campos de la tabla cursos en donde el campo docente_id tenga el mismo valor que la variable $docente_id. Así, me aseguro de traerme los datos que le corresponden a ESE docente.
               $res_curso2 = mysqli_query($link, $sql_curso2);
               $mostrar_curso2 = mysqli_fetch_array($res_curso2);


          }

?>
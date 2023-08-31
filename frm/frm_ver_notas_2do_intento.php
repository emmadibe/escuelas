<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="es">

<?php
    
    include "../alertas.php";
    include "../conexion.php";
    include "../barra.php";
    
    $docente_id = $_SESSION["docente_id"];
    $curso = $_GET["curso"];
    

    $sql_curso = "SELECT * FROM cursos WHERE curso='".$curso."' && docente_id = ".$docente_id;
    $res_curso = mysqli_query($link, $sql_curso);
    
    if (!$res_curso) {
        echo "Error executing the query: " . mysqli_error($link);
        exit;
    }
    
    $mostrar = mysqli_fetch_array($res_curso);
    $alto = $mostrar["cant_alumnos"];
    $curso_id = $mostrar["curso_id"];

   

?>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boostrap, librería de CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Boostrap, extensión de paletas de colores. Es para tener, entre otros, el color morado -->
    <link rel="stylesheet" href="path/to/bootstrap-extended-colors.css">

    <!-- Boostrap, librería de JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <!-- Decargué la versión minificada de la librería de JS en jQuery CDN. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
        <!-- Los links de arriba los tengo que copiar para que los modales y la barra desplegable me funcionen!! -->


    <title>Notas de los cursos</title>

    <style>

        body{

            background: <?php echo $mostrar["color_fondo"] ?>

        }

    </style>

</head>

<body>

   
    <div class="conteiner text-center">

        <div class="row">

            <div class="col-12 bg-success text-light"><h1>Curso <?php echo $mostrar["curso"] ?> de la <?php echo $mostrar["colegio"] ?> </h1></div>
            <!-- Con el atributo bg- modifico el color del fondo; con text, el del texto. Todo usando Boostrap. -->
        </div>

        <table class="table table-bordered" id="tabla">

            <thead>

                <tr>
                    
                    <th scope="col" style="background: yellow">
                        
                        Nombre alumno
                
                    </th>


                    <th scope="col" style="color: purple; background: pink"> 
                    
                        Agregar nota 
                    
                    </th>
                    <!-- El valor del atributo COLSPAN indica cuántas columnas adyacentes deben ser fusionadas en una sola celda, Sirve mucho para hacer encabezados.
                En cambio, el atributo ROWSPAN es utilizado en tablas para fusionar o unir celdas adyacentes en una misma columna. -->

                </tr>

            </thead>

            <tbody>

                <?php

                    for($i = 0; $i < $alto; $i++){ //Inicializo la variable i en 0. Mi condición de verdad es que el valor de la variable i sea menor al valor dela variable alto (cuyo valor es el de la variable cant_alumnos). Por cada vuelta, el valor de la variable i subirá en uno. O sea, mi condición de verdad se romperá cuando el valor de la variale i alcance al de la variable alto, el cual es el de cant_alumnos. Mientras que la condición de verdad se mantenga, se ejecutarán las acciones que están entre los corchetes. 

                        //Yo lo que quiero hacer es crear tantas filas (<tr>) como cantidad de alumnos (cant_alumnos) haya. A cada alumno, cada fila, le corresponderá un número del 1 hasta el número que indique cant_alumnos. La idea es, después, poder agregarle el nombre. 

                ?>

                <tr id="<?php echo ($i +1) ?>">
                        
                        <?php $r = $i + 1; ?>

                        <td scope="col" style="background: yellow" id="<?php echo ($r) ?>"> 

                            <?php echo $f = $i + 1 ?>

                            <?php

                            //if(!isset($_GET["numero"])){

                            ?>

                                <form method="POST" action="../acc/acc_guardar_notas_2do_intento.php?curso=<?php echo $curso ?>&numero= <?php echo $f ?>&curso_id=<?php echo $curso_id?>">

                                    <label for="nombre"></label>
                                    
                                    <input type="text" name="nombre">
                                    
                                    <input type="submit" name="boton" value="Guardar">

                                </form>

                            <?php

                               // }

                            ?>

                            <?php
    
                                if(isset($_GET["numero"])){//Me traigo la variable numero porque es más identificatorio que el nombre del alumno. El número no se va a repetir.

                                    $numero = $_GET["numero"];

                                    $sql_numero = "SELECT * FROM alumnos WHERE curso ='".$curso."' AND docente_id = ".$docente_id;
                                    //Me traigo todos los campos de la tabla alumnos en donde el campo curso sea igual a la variable curso. Eso es para traerme los datos de los alumnos del curso que me interesa. 
                                    $res_numero = mysqli_query($link, $sql_numero);
                                    $mostrar_numero = mysqli_fetch_array($res_numero);
                                    

                                    while ($fila = mysqli_fetch_array($res_numero)){
                                        if ($fila["numero"] == $i + 1){ //Lo hago para que coincida con el id de la celda. Así, solo se pondrá el nombre en la celda cuyo id coincide con el numero del alumno. 
                                            echo '<h4 style="color:red">'.ucfirst($fila["nombre"]).'</h4><br>';
                                        }
                                    }
//Gracias a este while y estos if, en cada celda me pondrá el nombre del alumno cuyo campo numero es igual al id de la celda (variable i + 2). Si no hiciera esto, aparecerían los nombres en todas las celdas. 
                                   
                                }

                            ?>

                            </td>  
                        

                            <td scope="col" style="background: pink" id="<?php echo $desde + 1 ?>">
                    
                                <form method="POST" action="../acc/acc_guardar_notas_2do_intento.php?curso=<?php echo $curso ?>&fila=<?php echo ($i + 1) ?>&curso_id=<?php echo $curso_id?>">

                                    <label for="nota"></label>
                                    <input type="number" min="1" max="10" placeholder="Ej: 7" name="nota">

                                    <input type="submit" name="boton" value="Guardar">

                                </form>

                            </td>

                            <td>

                                <?php

                                    $sql_notas = "SELECT * FROM alumnos WHERE curso ='".$curso."' && docente_id = ".$docente_id;
                                    $res_notas = mysqli_query($link, $sql_notas);
                                    $muestrate_1 = mysqli_fetch_array($res_notas);

                                 

                                    while ($fila_2 = mysqli_fetch_array($res_notas)) {

                                        if (($fila_2["numero"] == $i + 1) AND ($fila_2["curso_id"] == $curso_id)) {
                                      /*
                                            if ($fila_2['nota_array'] == NULL){
                                                // Si está vacío, no hay notas para imprimir
                                                echo "No hay notas para imprimir.";
                                            }else{
                                                // Si el campo nota_array tiene valores, obtenerlos y mostrarlos en pantalla
                                                $mostrar_deserializado = unserialize($fila_2['nota_array']);
                                                foreach ($mostrar_deserializado as $nota) {
                                                    echo $nota . "<br>";
                                                }
                                            }
                                       */           
                                                    $mostrar_deserializado = unserialize($fila_2['nota_array']);

                                                //    $desanidado = array_merge($mostrar_deserializado);

                                                    echo "<pre>";

                                                        print_r($mostrar_deserializado);

                                                    echo "</pre>";

                                        }

                                    }

                                    
                                    
                                // }

                                ?>

                            </td>

                    <?php
                            
                        }//Cierro bucle for

                    ?>



                </tr>     
                
              
                
            </tbody>

        </table>

    </div>

</body>

</html>
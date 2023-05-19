<!DOCTYPE html>
<html lang="es">
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

</head>

<body>

    <?php

        include "../alertas.php";
        include "../conexion.php";
        include "../barra.php";

        $curso = $_GET["curso"];

        $sql = "SELECT * FROM cursos WHERE curso='".$curso."'";
        $res = mysqli_query($link, $sql);
        $mostrar = mysqli_fetch_array($res);

        $alto = $mostrar["cant_alumnos"];

    ?>

    <div class="conteiner text-center">

        <div class="row">

            <div class="col-12 bg-success text-light"><h1>Curso <?php echo $mostrar["curso"] ?> de la <?php echo $mostrar["colegio"] ?> </h1></div>
            <!-- Con el atributo bg- modifico el color del fondo; con text, el del texto. Todo usando Boostrap. -->
        </div>

        <table class="table table-bordered" id="tabla">

            <thead>

                <tr>

                    <?php

                        $hasta = 10;

                    ?>

                    <th scope="col-2" style="background: yellow"> &nbsp; </th>
                    <th scope="col-12" style="color: purple; background: pink" colspan="<?php echo $hasta ?>"> Número de trabajo práctico </th>
                    <!-- El valor del atributo COLSPAN indica cuántas columnas adyacentes deben ser fusionadas en una sola celda, Sirve mucho para hacer encabezados.
                En cambio, el atributo ROWSPAN es utilizado en tablas para fusionar o unir celdas adyacentes en una misma columna. -->

                </tr>
                
                <tr>

                    <th scope="col" style="background: yellow">
                    
                        Nombre alumno
                
                    </th>

                    <?php

                        $partir = 0;

                        for ($partir; $partir < 10; $partir++){ //La variable partir inicia en cero. Mientras que esa variable sea menor a 10 (mi condición de verdad), se ejecutarán las acciones que están dentro de los corchetes. En cada vuelta (bucle), la variable partir aumentará en uno su valor (++).

                    ?>

                    <th scope="col" style="background: pink">
                    
                        <?php echo $partir + 1; ?>
                
                    </th> 
                    <!-- Cada columna tendrá un número hasta llegar a 10. Por 10 trabajos prácticos... -->

                    <?php

                        }

                    ?>

                </tr>

            </thead>

            <tbody>

                <?php

                    for($i = 0; $i < $alto; $i++){ //Inicializo la variable i en 0. Mi condición de verdad es que el valor de la variable i sea menor al valor dela variable alto (cuyo valor es el de la variable cant_alumnos). Por cada vuelta, el valor de la variable i subirá en uno. O sea, mi condición de verdad se romperá cuando el valor dela variale i alcance al de la variable alto, el cual es el de cant_alumnos. Mientras que la condición de verdad se mantenga, se ejecutarán las acciones que están entre los corchetes. 

                        //Yo lo que quiero hacer es crear tantas filas (<tr>) como cantidad de alumnos (cant_alumnos) haya. A cada alumno, cada fila, le corresponderá un número del 1 hasta el número que indique cant_alumnos. La idea es, después, poder agregarle el nombre. 

                ?>

                <tr id="<?php echo ($i +1) ?>">
                        
                        <?php $r = $i + 1; ?>

                        <td scope="col" style="background: yellow" id="<?php echo ($r) ?>"> 

                            <?php echo $f = $i + 1 ?>

                            <?php

                            //if(!isset($_GET["numero"])){

                            ?>

                                <form method="POST" action="../acc/acc_guardar_alumnos.php?curso=<?php echo $curso ?>&numero= <?php echo $f ?>">

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

                                    $sql_numero = "SELECT * FROM alumnos WHERE curso ='".$curso."'";
                                    //Me traigo todos los campos de la tabla alumnos en donde el campo curso sea igual a la variable curso. Eso es para traerme los datos de los alumnos del curso que me interesa. 
                                    $res_numero = mysqli_query($link, $sql_numero);
                                    $mostrar_numero = mysqli_fetch_array($res_numero);
                                    

                                    while ($fila = mysqli_fetch_array($res_numero)){
                                    if ($fila["numero"] == $i + 1){ //Lo hago para que coincida con el id de la celda. Así, solo se pondrá el nombre en la celda cuyo id coincide con el numero del alumno. 
                                    echo '<h4 style="color:red">'.ucfirst($fila["nombre"]).'</h4>';
                                    }
                                    }
//Gracias a este while y estos if, en cada celda me pondrá el nombre del alumno cuyo campo numero es igual al id de la celda (variable i + 2). Si no hiciera esto, aparecerían los nombres en todas las celdas. 
                                   
                                }

                              

                            ?>
                    
                        </td>
                        <!-- En la primer columna tenemos los números de los alumnos. Como el bucle inicia con la variable i valiendo 0, siempre le sumo un 1. Eso es lo que se verá en pantalla. No queda bien que un alumno sea el número 0.  -->

                        <?php

                            $desde = 0;
                        
                            while ($desde < $hasta){
                            //Este otro bucle lo hago para que e creen 10 columnas (ese es el valor dela variable hasta). Es para poder agregar las notas de los tp. 
                            //Como se puede apreciar, cree un bucle (while) dentro de otro (for).
                        ?>

                        <td scope="col" style="background: pink" id="<?php echo $desde + 1 ?>">
                    
                            <form method="POST" action="../acc/acc_guardar_alumnos.php?curso=<?php echo $curso ?>&fila=<?php echo ($i + 1) ?>&columna=<?php echo $desde + 1 ?>">

                                <label for="nota"></label>

                                <input type="number" min="1" max="10" placeholder="Ej: 7" name="nota">

                                <input type="submit" name="boton" value="Guardar">

                            </form>

                            <?php
    
                                    if(isset($_GET["columna"])){
                                            
                                        $columna = $_GET["columna"];
                                        $curso = $_GET["curso"];
                                        
                                        $sql_columna = "SELECT * FROM alumnos WHERE curso = '".$curso."'";
                                        $res_columna = mysqli_query($link, $sql_columna);
                                        $mostrar_columna = mysqli_fetch_array($res_columna);

                                        $columna_real = $mostrar_columna["columna"];

                                        while ($fila_columna = mysqli_fetch_array($res_columna)){ //Con este while, logro que las notas aprezcan en pnatalla en la columna y fila que deben aparecer.

                                            if($fila_columna["columna_".($desde + 1).""] == $desde + 1 AND $fila_columna["numero"] == $i + 1){
                                                //1) En la tabla "alumnos" de mi base de datos escuelas yo creo 10 campos llamados columna_1, columna_2 y así hasta llegar a columna_10. Recordar que la suma de 1 con la variable $desde me da el número de columna. Entonces, estoy diciendo que si columna_x es igual a columna... se hará la acción entre corchetes. 
                                                //2) Pero además de posicionarme en la columna correcta, debo posicionarme en la fila correcta para la asignación de las notas. La suma de 1 con l variable $i me da el número de fila. El campo "numero" de mi tabla "alumnos" tiene un valor que se corresponde con la fila en la que estarán las notas de ese alumno. 
                                                //3) O sea, mi condición de esta estructura condicional es que los valores de columna y de fila se correspondan a los de los campos columna y fila (numero).

                                                if($fila_columna["nota_".$fila_columna["columna_".($desde + 1).""].""] < 4){ //Si la nota es menor a 4, va aestar de color rojo.

                                                    echo"<h3 style='color:red'>";

                                                    }else if($fila_columna["nota_".$fila_columna["columna_".($desde + 1).""].""] > 4 AND $fila_columna["nota_".$fila_columna["columna_".($desde + 1).""].""] < 7){ //Si la nota esmayor a 4 y menor a 7, va a estar de color amarillo.

                                                        echo"<h3 style='color:yellow'>";

                                                        }else{//Solo queda una opción: que la nota sea mayor a 7. Ahí, estará de color verde.

                                                            echo"<h3 style='color:green'>";

                                                        }

                                                               echo $fila_columna["nota_".$fila_columna["columna_".($desde + 1).""].""].
                                                                //Imprimo la nota en pantalla. Recordá que en la tabla "alumnos" de mi base de datos escuela cree 10 campos llamados nota_1, nota_2 y así hasta llegar a nota_10. Como el número de nota se va a corresponder al número de columna, para saber qué nota es (si nota_1, nota_2, etc) saco el valor del campo columna. Para eso, debo hacer columna_". ($desde + 1) ya que la suma de 1 con $desde me arroja el número de columna.

                                                        "</h3>";
                                                    

                                            }

                                        }
                                    
                                     }
                                    
                            ?>
                    
                        </td>

                        <?php

                            $desde++;

                            }//Cierro bucle while

                        ?>

                </tr>

                <?php

                    }//Cierro bucle for

                ?>

            

            </tbody>

    </div>

</body>

</html>
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

    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script> 
    <!-- Librería para descargar la tabla en formato excel utilizando JS. -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <!-- Decargué la versión minificada de la librería de JS en jQuery CDN. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
        <!-- Los links de arriba los tengo que copiar para que los modales y la barra desplegable me funcionen!! -->


    <title>Notas de los cursos</title>

    <style>

        body{

            background: <?php echo $mostrar_curso["color_fondo"] ?>

        }

    </style>

</head>

<!--/////////////////////FUNCIONES:  -->



<!-- ///////////////////////////////////// -->

<body>

    <div class="conteiner text-center">
        
        <div class="row">
           <?php include "../conexion.php"; ?>
            <div class="col-12 bg-success text-light"> <h1>Curso <?php  echo $mostrar_curso["curso"] ?> de la <?php echo $mostrar_curso["colegio"] ?> </h1></div>
            <!-- Con el atributo bg- modifico el color del fondo; con text, el del texto. Todo usando Boostrap. -->
        </div>

        <table class="table table-bordered" id="miTabla">
            <!-- Se crea un id a la tabla para que la función exportarTabla de JS sepa qué tabla me debe descargar en formato excel -->

            <thead>

                <div class = "row">

                    <div class = "col-4">

                            <!-- MODAL EDITAR -->
                            <div class="modal fade" id="modal_editar_alumno" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-primary"> <?php //Aquí edito el color de fondo del cuerpo del modal ?>
                                    <div class="modal-header bg-warning"> <?php //Como su nombre lo indica (header = cabeza), aquí eduçito el color de fondo de la cabecera del modal ?>
                                        <h5 class="modal-title" id="exampleModalLabel" style="color:green">Hola, <?php echo $_SESSION["nombre"]; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h6 style="color:pink">¿Desea editar el alumno?</h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <a href="frm_editar_alumno.php?curso_id=<?php echo $mostrar_curso2["curso_id"] ?>&curso=<?php echo $curso?>" class="btn btn-primary"> Editar alumnos</a> <?php //Me llevo el curso y el docente_id para que el programa sepa qué datos editarme ?>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- FIN DE MODAL EDITAR -->
                            <!-- Botón que me abrirá el modal editar: -->
                             <button type="button" class="btn btn-warning boton_editar_curso"  id=""data-toggle="modal" data-target="#modal_editar_alumno"><i class="bi bi-pen">Editar alumnos</i></button> 


                    </div>
                    
                    <div class = "col-4">

                          <!-- -------------------------------------MODAL ELIMINAR------------------------------------------------ -->

                          <div class="modal" tabindex="-1" id="modal_eliminar_alumno">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title ">ATENCIÓN, administrador <?php echo $_SESSION["nombre"] ?>!!</h5> 
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Seleccione la fila del alumno a eliminar</p>
                                                    <div class="modal-body">

                                                        <form method="POST" action="../acc/acc_eliminar_alumno.php?curso=<?php echo $curso ?>&curso_id=<?php echo $curso_id?>">
                                                            <label for="fila"></label>
                                                            <input type="text" name="fila" class="form-control" placeholder="4">                                                        
                                                    
                                                            <p>Esta accion no se puede revertir.</p>
                                                        
                                                           
                                                            <input type="submit" style="color:black; background:red; font-size: 22px;" name="boton" value="Eliminar">
                                                        </form>

                                                    </div>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" width="22%">Cancelar</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>       <?php //En este modal necesito un input porque el usuario debe seleccionar qué alumno eliminar a través de la fila. Si escriba el 2, se eliminará el alumno correspondiente a la fila 2. ?>

                                          <!-- Botón que abrirá el Modal de eliminar -->
                                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_alumno" data-whatever="@mdo">Eliminar un alumno</button>
                                    <!-- /////////////////////////////////// -->

                    </div>

                  <!-- MODAL PARA CAMBIAR LA CANTIDAD DE NOTAS -->

                    <div class = "col-4">

                            <!-- MODAL PARA CAMBIAR LA CANTIDAD DE NOTAS -->
                            <div class="modal fade" id="modal_cambiar_cant_notas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-primary"> <?php //Aquí edito el color de fondo del cuerpo del modal ?>
                                    <div class="modal-header bg-warning"> <?php //Como su nombre lo indica (header = cabeza), aquí eduçito el color de fondo de la cabecera del modal ?>
                                        <h5 class="modal-title" id="exampleModalLabel" style="color:green">Hola, <?php echo $_SESSION["nombre"]; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h6 style="color:pink">¿Desea cambiar la cantidad de notas?</h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <a href="frm_cambiar_cant_notas.php?curso_id=<?php echo $mostrar_curso2["curso_id"] ?>&curso=<?php echo $mostrar_curso2["curso"]?>" class="btn btn-primary"> Cambiar la cantidad de notas</a> <?php //Me llevo el curso y el docente_id para que el programa sepa qué datos editarme ?>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- FIN DE MODAL PARA CAMBIAR LA CANTIDAD DE NOTAS -->
                            <!-- Botón que me abrirá el modal para cambiar la cantidad de notas: -->
                             <button type="button" class="btn btn-warning boton_editar_curso"  id=""data-toggle="modal" data-target="#modal_cambiar_cant_notas"><i class="bi bi-pen">Cambiar la cantidad de notas</i></button> 


                    </div>

                </div>

                <tr>
                    
                    <th scope="col" style="background: yellow">
                        
                        Nombre alumno
                
                    </th>


                    <th scope="col" style="color: purple; background: pink"> 
                    
                        Agregar nota 
                    
                    </th>
                    <!-- El valor del atributo COLSPAN indica cuántas columnas adyacentes deben ser fusionadas en una sola celda, Sirve mucho para hacer encabezados.
                En cambio, el atributo ROWSPAN es utilizado en tablas para fusionar o unir celdas adyacentes en una misma columna. -->

                    <?php
                        //Imprimamos una columna por cada tp. 
                        
                        include "../conexion.php"; 
                        for($o = 1; $o < $mostrar_curso["cant_notas"]; $o++){ //Creo un bucle en donde me genere tantas columnas nuevas en el cabezal (thead) hasta que el valor de $o llegue al de $cant_notas. O sea, la idea es tener una columna por cada nota.

                    ?>

                            <th>

                                <?php
                                        
                                    echo '<span style="color: pink">TP Nº'. $o. '</span>'; //$o representa el número de tp. 
                                    
                                    echo '<br>';

                                ?>

                            </th>

                    <?php

                        }

                    ?>

                    <th scope="col" style="color: black; background: gray">

                        Promedios

                    </th>

                    <th scope="col" style="color: red; background: black">

                        Nota Conceptual

                    </th>

                </tr>

            </thead>

            <tbody>

                <?php

                    for($i = 0; $i < $alto; $i++){ //Inicializo la variable i en 0. Mi condición de verdad es que el valor de la variable i sea menor al valor dela variable alto (cuyo valor es el de la variable cant_alumnos). Por cada vuelta, el valor de la variable i subirá en uno. O sea, mi condición de verdad se romperá cuando el valor de la variale i alcance al de la variable alto, el cual es el de cant_alumnos. Mientras que la condición de verdad se mantenga, se ejecutarán las acciones que están entre los corchetes. 

                        //Yo lo que quiero hacer es crear tantas filas (<tr>) como cantidad de alumnos (cant_alumnos) haya. A cada alumno, cada fila, le corresponderá un número del 1 hasta el número que indique cant_alumnos. La idea es, después, poder agregarle el nombre. 

                ?>

                <tr id="<?php echo ($i +1) ?>">
                        
                        <?php $r = $i + 1; ?>

                        <td scope="col" style="background: yellow; width: 150px" id="<?php echo ($r) ?>"> 

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

                                    include "../conexion.php";

                                    while ($fila = mysqli_fetch_array($res_notas)){
                                        if ($fila["numero"] == $i + 1 AND $fila["curso_id"] ==$curso_id){ //Lo hago para que coincida con el id de la celda. Así, solo se pondrá el nombre en la celda cuyo id coincide con el numero del alumno. También me aseguro que me traiga los nombres solo de ese curso_id
                                            echo '<h4 style="color:red">'.ucfirst($fila["nombre"]).'</h4><br>';
                                        }
                                    }
//Gracias a este while y estos if, en cada celda me pondrá el nombre del alumno cuyo campo numero es igual al id de la celda (variable i + 2). Si no hiciera esto, aparecerían los nombres en todas las celdas. 
                                   
                                

                            ?>

                            </td>  
                        

                            <td scope="col" style="background: pink; width: 150px" id="<?php echo $desde + 1 ?>">
                    
                                <form method="POST" action="../acc/acc_guardar_notas_2do_intento.php?curso=<?php echo $curso ?>&fila=<?php echo ($i + 1) ?>&curso_id=<?php echo $curso_id?>">

                                    <label for="nota"></label>
                                    <input type="number" min="1" max="10" placeholder="Ej: 7" name="nota">

                                    <input type="submit" name="boton" value="Guardar">

                                </form>

                            </td>

                            <?php
                                /////////////////////IMPRIMAMOS LAS NOTAS EN PANTALLA/////////////////////////////////////////////////////////////////////
                                for($x = 1; $x < $mostrar_curso["cant_notas"]; $x++){

                                    ?>

                                        <td>

                                    <?php

                                            include "../conexion.php";

                                            while ($fila_3 = mysqli_fetch_array($res_notas)) { //Mientras que haya información en $res_notas_3, me ejecuta el bucle.
                                                    if (($fila_3["numero"] == $i + 1) AND ($fila_3["curso_id"] == $curso_id)) { //Compruebo que el número del alumno sea el mismo que el de la fila; así, se imprime la nota en la celda, en el alumno que corresponde.

                                                        if ($fila_3['nota_array'] == NULL){
                                                            // Si está vacío, no hay notas para imprimir
                                                            echo "No hay notas para imprimir.";
            
                                                        }else{
                                                            // Si el campo nota_array tiene valores, obtenerlos y mostrarlos en pantalla
                                                            $mostrar_deserializado = unserialize($fila_3['nota_array']); //Debo deserializar el array antes que nada.
            
                                                            if(!isset($mostrar_deserializado[$x - 1])){ //Si no hago esta validación, y $mostrar_deserializado[$x - 1] no existe, me va a tirar un error re feo en la página.

                                                                echo'<h6 style="color:red">Sin entregar</h6>';

                                                            }else{ 
                                                                
                                                                $nota = $mostrar_deserializado[$x-1]; // Acceder al elemento en el índice $x-1. Así, imprimo un elemento del array en cada columna de notas.

                                                                echo '<span style="color:'; //Depende del valor de la variable $nota el color que tenga.

                                                                if($nota >= 7){

                                                                    echo 'green';

                                                                }else if($nota >=4 && $nota <7){

                                                                    echo 'yellow';

                                                                    
                                                                }else{

                                                                    echo 'red';

                                                                }                         

                                                                echo '">' .$nota. '</span>';
                
                                                            }

                                                        }
                                                    
                                                    }
    
                                            }//while
    
                                        
                                }//for
                                                    
                                                    
                                            ?>

                                        </td>

                                    <?php

                                }                         
                                ///////////////////////////////////FIN DE IMPRIMIR LAS NOTAS EN PANTALLA///////////////////////////////////////////////////////
                            ?>
                            
                            <td style="color : black; background: gray">
                                <?php

                                    include "../conexion.php";

                                    while ($fila_4 = mysqli_fetch_array($res_notas)) { 

                                        $suma = 0;

                                        if (($fila_4["numero"] == $i + 1) AND ($fila_4["curso_id"] == $curso_id)) {

                                            for($y= 0; $y <= $mostrar_curso["cant_notas"]; $y++){

                                                $mostrar_deserializado = unserialize($fila_4['nota_array']);

                                                if(!isset($mostrar_deserializado[$y])){ //Si no existe el índice $y del array $mostrar_deserializado hago que a la variable $suma se le sume 0. Si no hago esta validación, y dicho índice no existe, me va a saltar un error.

                                                    $suma+= 0;

                                                }else{

                                                    $suma += $mostrar_deserializado[$y];

                                                }

                                            }

                                            $resultado = $suma / $mostrar_curso["cant_notas"]; //En la variable $resultado se almacenará un float con el cociente de $suma y $mostrar_curso["cant_notas"].
                                            $resultado_formateado = number_format($resultado, 2); // Limita a 2 decimales. number_format() es una función que recibe dos parámetros. El primer parámetro es un dato de tipo float, el cual queremos limitar sus decimales; el segundo, es un int con la cantidad de decimales que deseo tener.

                                            echo $resultado_formateado;

                                        }

                                    }

                                ?>
                            </td>

                            <td style="color : red; background: black">   <?php //En esta columa imprimiré la nota conceptual: TEA; TEP o TED. ?>
                                
                                    <?php

                                        include "../conexion.php";

                                        while ($fila_4 = mysqli_fetch_array($res_notas)) { //Tengo que volver a sumar cada nota y la divido por la cantidad total de notas ($mostrar_curso["cant_notas"])

                                            $suma = 0;

                                            if (($fila_4["numero"] == $i + 1) AND ($fila_4["curso_id"] == $curso_id)) {

                                                for($y= 0; $y <= $mostrar_curso["cant_notas"]; $y++){

                                                    $mostrar_deserializado = unserialize($fila_4['nota_array']);

                                                    if(!isset($mostrar_deserializado[$y])){ //Si no existe el índice $y del array $mostrar_deserializado hago que a la variable $suma se le sume 1. Si no hago esta validación, y dicho índice no existe, me va a saltar un error.
                                                                                        //En la escuela no se puede poner 1.
                                                        $suma+= 1;

                                                    }else{

                                                        $suma += $mostrar_deserializado[$y];

                                                    }

                                                }

                                                if( ($suma / $mostrar_curso["cant_notas"]) >= 7 ){

                                                    echo '<h3 style="color:green">TEA</h3>';

                                                }else if(($suma / $mostrar_curso["cant_notas"]) < 7 && ($suma / $mostrar_curso["cant_notas"]) >= 4){

                                                    echo '<h3 style="color:yellow">TEP</h3>';

                                                }else{

                                                    echo'<h3 style="color:red">TED</h3>';

                                                }

                                            }

                                    }

                                    ?>

                            </td>

                    <?php
                            } //Find el bucle for general.

                    ?>

                </tr>     
                
              
                
            </tbody>

        </table>

    </div>

    <div class="col">

        <button onclick="exportarTabla()" style="color:green"><i class="bi bi-filetype-xls"> Descargar Excel</i></button>
        <!-- Esta línea crea un botón con el texto "Exportar a Excel". Cuando se hace clic en el botón, se ejecutará la función exportarTabla()que se define abajo. -->

    </div>

    <script>


        $(document).ready(function(){//Sobre este documento, este archivo, cuando esté listo realizá las siguientes funciones o actividades:

            ////////////////Cambiemos las alertas para que desaparezcan después de unos segundos:
            $('.alert button').hide();

            setInterval(function(){
                $('.alert').hide("slow");
            }, 3000); //Oculta las alertas luego de que pasen 3000 milisegundos (3 segundos).

        })

        function exportarTabla() { //Esta función entrará en acción cuando se haga click en el boton que dice onclick="exportarTabla".
      // Obtener la tabla HTML
            var tabla = document.getElementById('miTabla'); //Esta línea obtiene la referencia al elemento de la tabla HTML con el ID "miTabla" utilizando el método getElementById(). La referencia se almacena en la variable tabla.

            // Crear un libro de Excel
            var libro = XLSX.utils.table_to_book(tabla); //Esta línea utiliza la función table_to_book()de la biblioteca SheetJS para convertir la tabla HTML en un libro de Excel. El libro resultante se almacena en la variable libro.

            // Guardar el libro como archivo de Excel
            XLSX.writeFile(libro, 'notas_<?php echo $curso ?>_<?php echo $mostrar_curso["colegio"] ?>.xlsx'); // Esta línea utiliza la función writeFile()de la biblioteca SheetJS para guardar el libro como un archivo de Excel con el nombre "notas_NOMBRECURSO_colegio". El archivo se descargará en el navegador del usuario cuando se ejecute esta línea.
        }

    </script>


</body>

</html>
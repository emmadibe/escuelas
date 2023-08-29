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


    <title>Cursos</title>

    <style>

        h1{
            
            color:purple;

        }    

        body{

            background:#E0FFFF;

        }

    </style>
</head>

<body>

    <?php

        SESSION_START();

        $docente_id = $_SESSION["docente_id"];

        include "../barra.php";
        include "../alertas.php";
        include "../conexion.php";

        $sql = "SELECT * FROM cursos WHERE docente_id = ".$docente_id; //Traeme todos los datos de todos los campos de la tabla cursos en donde el campo docente_id tenga el mismo valor que la variable $docente_id. Así, me aseguro de traerme los datos que le corresponden a ESE docente.
        $res = mysqli_query($link, $sql);
        $mostrar = mysqli_fetch_array($res);

    ?>

    <div class="conteiner text-center">

        <div class="row">

            <div class="col-12"><hr><h1 style="color:black">¡Hola, <?php echo $_SESSION["nombre"]; ?>!</h1><hr></div>

        </div>

        <div class="row">

            <div class="col-12"><hr><h1>Crear curso</h1><hr></div>

        </div>

   


    <div class="row">

        <div class="col-4">

            &nbsp;

        </div>

        <div class="col-4">

            <form action="../acc/acc_guardar_curso.php" method="GET">
        
        <div class="form-group">

            <label for="colegio">Escribir el nombre del colegio</label>
            <input type="text" required name="colegio" placeholder="EJ: EES79">
         
        </div>

        <div class="form-group">

            <label for="curso">Escribir el nombre del curso</label>
            <input type="text" required name="curso" placeholder="EJ: 4to1ra">
         
        </div>

        <div class="form-group">

            <label for="cant_alumnos">Cantidad de alumnos</label>
            <input type="number" min="1" max="100" required name="cant_alumnos" placeholder="EJ: 27">    

        </div>

        <div class="form-group">

            <label for="cant_notas">Cantidad de notas</label>
            <input type="number" min="1" max="100" required name="cant_notas" placeholder="EJ: 27">    

        </div>

        <div class="form-group">

            <label for="color_fondo">Seleccionar el color de fondo favorito</label>
            <select class="form-control" name="color_fondo">

                <option value="purple">Violeta</option>
                <option value="yellow">Amarillo</option>
                <option value="white">Blanco</option>
                <option value="red">Rojo</option>
                <option value="green">Verde</option>
                <option value="pink">Rosa</option>
                <option value="black">Negro</option>

            </select>

        </div>

        <div class="form-group">

            <label for="color_tabla">Seleccionar el color de la tabla</label>

                <select class="form-control" name="color_tabla">

                    <option value="table-active">Negro</option>
                    <option value="table-danger">Rojo</option>
                    <option value="table-warning">Amarillo</option>
                    <option value="table-success">verde</option>

                </select>

        </div>

        <div class="form-group">

            <label for="color_click">Seleccionar el color al que debe cambiar la tabla al hacer click con el mouse</label>

                <select class="form-control" name="color_click">

                    <option value="table-active">Negro</option>
                    <option value="table-danger">Rojo</option>
                    <option value="table-warning">Amarillo</option>
                    <option value="table-success">verde</option>

                </select>

        </div>

        <div class="form-group">

            <label for="color_barra">Seleccionar el color de la barra</label>

                <select class="form-control" name="color_barra">

                    <option value="bg-dark">Negro</option>
                    <option value="bg-danger">Rojo</option>
                    <option value="bg-light">gris</option>
                    <option value="bg-success">verde</option>

                </select>

        </div>


                <button type="submit" class="btn btn-warning" name="boton">Crear curso</button>

                <br><br>

             </form>

        </div>

        <div class="col-4">

            &nbsp;

        </div>

        <br><br>

    </div>

    <br>

    <div class="row">

        <div class="col-12"><hr><h1 style="color:black">Mis cursos:</h1><hr></div>

    </div>

        <br>


    <table class="table">

        <thead>

            <tr>
            <th scope="col">Nombre del curso</th>
            <th scope="col">Escuela</th>
            <th scope="col">Cantidad de alumnos</th>
            <th scope="col">Ingresar al curso</th>
            <th scope="col"> <i class="bi bi-archive-fill bg-danger">Eliminar curso</i></th>
            <th scope="col"> <i class="bi bi-brush bg-warning">Editar curso</i></th>
            </tr>

        </thead>

        <tbody>

            <?php

                while ($fila = mysqli_fetch_array($res)){ //Mientras que existan datos en $res, me los va a traer.

            ?>
                    <tr>

                        <th scope="row"> <?php echo $fila["curso"] ?> </th>
                        <td> <?php echo $fila["colegio"] ?> </td>
                        <td> <?php echo $fila["cant_alumnos"] ?> </td>
                        <td> 

                            <button type="button" class="btn btn-success"><a href="frm_ver_notas_2do_intento.php?columna=x&numero=1&curso=<?php echo $fila["curso"] ?>&curso_id=<?php echo $fila["curso_id"]?>" class="btn btn-success"> <i class="bi bi-arrow-right-square-fill">Entrar</i></a></button>

                        </td>

                        <td>

                            <!--  --------------MODAL ELIMINAR----------    -->
                            <div class="modal" tabindex="-1" id="modal_eliminar<?php echo $mostrar["curso"]; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title ">ATENCIÓN, <?php echo $_SESSION["nombre"] ?>!!</h5> 
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>¿Está seguro de eliminar el curso <?php echo $mostrar["curso"]?>?</p>
                                                    <p>Esta accion no se puede revertir.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <a href="../acc/acc_borrar_curso.php?docente_id=<?php echo $mostrar["docente_id"] ?>&curso=<?php echo $mostrar["curso"]; ?>" class="btn btn-danger">Eliminar partida</a>
                                                    <!-- Si aprieto "Eliminar Partida", el botón, que es un vínculo con forma de botón, me reedirige a acc_borrar_cursos.php. -->
                                                </div>
                                            </div>
                                            </div>
                            </div>
                                        
                                
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar<?php echo $mostrar["curso"]; ?>"><i class="bi bi-x-octagon-fill"></i></button>  
                                        <!-- El modal y el ícono de la cruz lo saco de Boostrap. 
                                        Al hacer click sobre el botón abre el modal cuyo target es el id (#) modal_eliminarnombrecurso. Acordate que el # indica que es un id. Entonces, cuando clickeo el botón abre el elemento que tenga ese id.
                                                Me llevo la variable $mostrar["curso"] a acc_borrar_curso.php vía URL (GET) para que el sistema sepa qué dato, que curso, borrar.
                                            Obviamente, también mellevo a la variable docente_id para que sepa de qué docente es el curso.
                                            -->

                        </td>

                        <td>
                            <!-- MODAL EDITAR -->
                            <div class="modal fade" id="modal_editar_curso<?php echo $fila["curso"]?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-primary"> <?php //Aquí edito el color de fondo del cuerpo del modal ?>
                                    <div class="modal-header bg-warning"> <?php //Como su nombre lo indica (header = cabeza), aquí eduçito el color de fondo de la cabecera del modal ?>
                                        <h5 class="modal-title" id="exampleModalLabel" style="color:green">Hola, <?php echo $_SESSION["nombre"]; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h6 style="color:pink">¿Desea editar el curso <?php echo $fila["curso"] ?>?</h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <a href="frm_editar_curso.php?docente_id=<?php echo $mostrar["docente_id"] ?>&curso=<?php echo $fila["curso"]; ?>" class="btn btn-primary"> Editar curso</a> <?php //Me llevo el curso y el docente_id para que el programa sepa qué datos editarme ?>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- FIN DE MODAL EDITAR -->
                            <!-- Botón que me abrirá el modal editar: -->
                             <button type="button" class="btn btn-warning boton_editar_curso"  id="<?php echo $fila["curso"] ?>"data-toggle="modal" data-target="#modal_editar_curso<?php echo $fila["curso"] ?>"><i class="bi bi-pen"></i></button> 


                        </td>
                 
                    </tr>

            <?php

                }

            ?>

        </tbody>

    </div> <?php //conteiner ?> 


 
</body>

</html>
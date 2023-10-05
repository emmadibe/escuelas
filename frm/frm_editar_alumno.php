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


        <title>Editar alumnos</title>

    </head>

    <body>

        <?php

            include "../conexion.php";

            SESSION_START(); 

            $curso_id = $_GET["curso_id"];
            $curso = $_GET["curso"];
        
            $docente_id = $_SESSION["docente_id"];

        ?>

        <div class="conteiner text-center">

        <div class="row">

            <div class="col-12"><hr><h1 style="color:black">¡Hola, <?php echo $_SESSION["nombre"]; ?>!</h1><hr></div>

        </div>

        <div class="row">

            <div class="col-12"><hr><h1>Editar alumnos</h1><hr></div>

        </div>

        <div class="row">

        <div class="col-4">

            &nbsp;

        </div>

        <div class="col-4">
            <form action="../acc/acc_editar_alumno.php?curso_id=<?php echo $curso_id?>&curso=<?php echo $curso?>" method="POST">

            <div class="form-group">
                <label for="fila">Escribir el número de fila del alumno a editar</label>
                <input type="number" required name="fila" placeholder="EJ: 2" min="1" id="myInput" max="<?php echo $alto;?>">
                
                <!-- Es común que aparezca visible el valor original del dato a modificar. -->
            </div>

            <div class="form-group">

                <label for="numNota">Escribir el número de nota que desea editar</label>
                <input type="number" required name="numNota" placeholder="Ej: 3" min="1">

            </div>

            <div class="form-group">

                <label for="valNota">Valor nota:</label>
                <input type="number" required name="valNota" placeholder="Ej: 7" min="1" max="10">

            </div>

            <button type="submit" class="btn btn-warning" name="boton">Editar alumno</button>

            <br><br>

            </form>

        </div>

    </body>

</html>


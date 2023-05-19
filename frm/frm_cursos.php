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

        include "../alertas.php";
        include "../conexion.php";

        $sql = "SELECT * FROM cursos";//Cuando cree el usuario pondré: WHERE usuario_id = $usuario_id para que solo me trtaiga los cursos de ESE usuario_id (sería un docente).
        $res = mysqli_query($link, $sql);

    ?>

    <div class="conteiner text-center">

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
            </tr>

        </thead>

        <tbody>

            <?php

                while ($fila = mysqli_fetch_array($res)){

            ?>
                    <tr>
                    <th scope="row"> <?php echo $fila["curso"] ?> </th>
                    <td> <?php echo $fila["colegio"] ?> </td>
                    <td> <?php echo $fila["cant_alumnos"] ?> </td>
                    <td> 

                         <button type="button" class="btn btn-success"><a href="frm_notas.php?columna=x&numero=1&curso=<?php echo $fila["curso"] ?>" class="btn btn-success"> <i class="bi bi-arrow-right-square-fill">Entrar</i></a></button>

                    </td>
                    </tr>

            <?php

                }

            ?>

        </tbody>

    </div> <?php //conteiner ?> 

</body>

</html>
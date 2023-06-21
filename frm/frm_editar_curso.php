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
            
            color:green;

        }    

        body{

            background:pink;

        }

    </style>
</head>

<body>

    <?php

        SESSION_START();
        include "../conexion.php";
        //Descargo las variables tarídas vía url (GET) desde frm_cursos.php para que el programa sepa qué datos actualizarme.
        $curso_original = $_GET["curso"]; 
        $docente_id = $_GET["docente_id"];

        $sql ="SELECT * FROM cursos WHERE curso = '".$curso_original."' AND docente_id = $docente_id";
        $res = mysqli_query($link, $sql);
        $mostrar = mysqli_fetch_array($res);

        $curso_id = $mostrar["curso_id"]; //Me traigo el curso_id poraque no se repite. Es la mejor forma de que el programa sepa que dato editar. Esta variable me la voy a llevar a acc_editar_curso.php

    ?>

    <div class="conteiner text-center">

    <div class="row">

        <div class="col-12"><hr><h1 style="color:black">¡Hola, <?php echo $_SESSION["nombre"]; ?>!</h1><hr></div>

    </div>

    <div class="row">

        <div class="col-12"><hr><h1>Editar el curso <?php echo $curso_original ?></h1><hr></div>

    </div>

    <div class="row">

    <div class="col-4">

        &nbsp;

    </div>

    <div class="col-4">

        <form action="../acc/acc_editar_curso.php?curso_id=<?php echo $curso_id; ?>" method="POST">

    <div class="form-group">

        <label for="colegio">Escribir el nombre del colegio</label>
        <input type="text" required name="colegio" placeholder="<?php echo $mostrar["colegio"] ?>">
        <!-- Es común que aparezca visible el valor original del dato a modificar. -->
    </div>

    <div class="form-group">

        <label for="curso">Escribir el nombre del curso</label>
        <input type="text" required name="curso" placeholder="<?php echo $mostrar["curso"] ?>">
    
    </div>

    <div class="form-group">

        <label for="cant_alumnos">Cantidad de alumnos</label>
        <input type="number" min="1" max="100" required name="cant_alumnos" placeholder="<?php echo $mostrar["cant_alumnos"] ?>">    

    </div>

    <div class="form-group">

        <label for="cant_notas">Cantidad de notas</label>
        <input type="number" min="1" max="100" required name="cant_notas" placeholder="<?php echo $mostrar["cant_notas"] ?>">    

    </div>

    <div class="form-group">

        <label for="color_fondo">Seleccionar el color de fondo favorito</label>
        <select class="form-control" name="color_fondo">
            <?php if(($mostrar["color_fondo"])=="purple"){ ?>
                <option value="purple" selected>Violeta</option>
                <?php }else{ ?>
                <option value="purple">Violeta</option>
                <?php }
                    if (($mostrar["color_fondo"]) == "pruple"){ ?>
                <option value="yellow" selected>Amarillo</option>
                <?php }else{ ?>
                <option value="yellow">Amarillo</option>
                <?php }
                    if (($mostrar["color_fondo"]) == "white"){ ?>
                <option value="white" selected>Blanco</option>
                <?php }else{ ?>
                <option value="white">Blanco</option>
                <?php }
                        if (($mostrar["color_fondo"]) == "red"){ ?>
                <option value="red" selected>Rojo</option>
                <?php }else{ ?>
                <option value="red">Rojo</option>
                <?php }
                        if(($mostrar["color_fondo"]) == "green"){ ?>
                <option value="green" selected>Verde</option>
                <?php }else{ ?>
                <option value="green">Verde</option>
                <?php }
                        if(($mostrar["color_fondo"]) == "pink"){ ?>
                <option value="pink" selected>Rosa</option>
                <?php }else{ ?>
                <option value="pink">Rosa</option>
                <?php }
                        if(($mostrar["color_fondo"]) == "black"){ ?>
                <option value="black" selected>Negro</option>
                <?php }else{ ?>
                <option value="black">Negro</option>
                <?php } ?>
                <!-- Con los if hago que aparezca de manera predeterminada (selected) el color de fondo original elegido por el docente. Por eso, por ejemplo, si color_fondo es igual al string "green" aparecerá como opción predeterminada "Verde; sino, aparecerá como una opción más. Y así con cada opción de color de fondo.  -->


        </select>

    </div>

    <div class="form-group">

        <label for="color_tabla">Seleccionar el color de la tabla</label>

            <select class="form-control" name="color_tabla">
                <?php if(($mostrar["color_tabla"]) == "table-active"){ ?>
                    <option value="table-active" selected>Negro</option>
                    <?php }else{ ?>
                    <option value="table-active">Negro</option>
                    <?php }
                        if(($mostrar["color_tabla"]) == "table-danger"){ ?>
                    <option value="table-danger" selected>Rojo</option>
                    <?php }else{ ?>
                    <option value="table-danger">Rojo</option>
                    <?php }
                        if(($mostrar["color_tabla"]) == "table-warning"){ ?>
                    <option value="table-warning" selected>Amarillo</option>
                    <?php }else{ ?>
                    <option value="table-warning">Amarillo</option>
                    <?php }
                        if(($mostrar["color_tabla"]) == "table-success"){ ?>
                    <option value="table-success" selected>verde</option>
                    <?php }else{ ?>
                    <option value="table-success">verde</option>
                    <?php } ?>

            </select>

    </div>

    <div class="form-group">

        <label for="color_barra">Seleccionar el color al que debe cambiar la tabla al hacer click con el mouse</label>

            <select class="form-control" name="color_click">

                    <?php if(($mostrar["color_tabla"]) == "table-active"){ ?>
                    <option value="table-active" selected>Negro</option>
                    <?php }else{ ?>
                    <option value="table-active">Negro</option>
                    <?php }
                        if(($mostrar["color_tabla"]) == "table-danger"){ ?>
                    <option value="table-danger" selected>Rojo</option>
                    <?php }else{ ?>
                    <option value="table-danger">Rojo</option>
                    <?php }
                        if(($mostrar["color_tabla"]) == "table-warning"){ ?>
                    <option value="table-warning" selected>Amarillo</option>
                    <?php }else{ ?>
                    <option value="table-warning">Amarillo</option>
                    <?php }
                        if(($mostrar["color_tabla"]) == "table-success"){ ?>
                    <option value="table-success" selected>verde</option>
                    <?php }else{ ?>
                    <option value="table-success">verde</option>
                    <?php } ?>

            </select>

    </div>

    <div class="form-group">

        <label for="color_barra">Seleccionar el color de la barra</label>

            <select class="form-control" name="color_barra">

                    <?php if(($mostrar["color_tabla"]) == "table-active"){ ?>
                    <option value="table-active" selected>Negro</option>
                    <?php }else{ ?>
                    <option value="table-active">Negro</option>
                    <?php }
                        if(($mostrar["color_tabla"]) == "table-danger"){ ?>
                    <option value="table-danger" selected>Rojo</option>
                    <?php }else{ ?>
                    <option value="table-danger">Rojo</option>
                    <?php }
                        if(($mostrar["color_tabla"]) == "table-warning"){ ?>
                    <option value="table-warning" selected>Amarillo</option>
                    <?php }else{ ?>
                    <option value="table-warning">Amarillo</option>
                    <?php }
                        if(($mostrar["color_tabla"]) == "table-success"){ ?>
                    <option value="table-success" selected>verde</option>
                    <?php }else{ ?>
                    <option value="table-success">verde</option>
                    <?php } ?>

            </select>

    </div>


            <button type="submit" class="btn btn-warning" name="boton">Editar curso</button>

            <br><br>

        </form>

    </div>

    <div class="col-4">

        &nbsp;

    </div>

    </div>

    <br><br>

    <div class="row">

        <div class="col-12">

            <a href="frm_cursos.php" class="btn btn-light"><img src="../volver.jpg" width="70%" alt="Volver al menú principal"></a>
            <!-- Acordate que el valor del atributo alt de la etiqueta img es un texto que se mostrará en pantalla por si la imagen, por alguna razón, no puede verse. Es una suerte de auxilio. Viene bien agregar ese atributo por cualquier cosa. -->

        </div>

    </div>

    </div>

    <br>

</body>
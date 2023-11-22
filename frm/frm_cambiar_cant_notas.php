
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

        h4{

            background: pink;

            color: black;

        }

        input{

            background: lightblue;

        }

    </style>

</head>

<!--/////////////////////FUNCIONES:  -->



<!-- ///////////////////////////////////// -->

<body>

    <?php

        if(isset($_GET["curso_id"])){

            $curso_id = $_GET["curso_id"];
            $curso = $_GET["curso"];

            $sql = "SELECT * FROM cursos WHERE docente_id = ".$docente_id." AND curso_id = ".$curso_id;
            $res = mysqli_query($link, $sql);
            $mostrar = mysqli_fetch_array($res);
            
            $cant_nota_anterior = $mostrar["cant_notas"] - 1;
    ?>

            <div class="conteiner text-center">

                <table class="table table-bordered" id="miTabla">
                            <!-- Se crea un id a la tabla para que la función exportarTabla de JS sepa qué tabla me debe descargar en formato excel -->

                            <thead>

                                <div class = "row">

                                    <div class = "col-12">

                                        <h4>Cambiar la cantidad de notas</h4>

                                    </div>

                                </div>

                            </thead>

                            <tbody>

                                <div class ="row">

                                    <div class="col-12">

                                    <form method="POST" action="../acc/acc_cambiar_cant_notas.php?curso=<?php echo $curso?>&curso_id=<?php echo $curso_id?>">

                                        <label for="cant_notas"></label>

                                        <input type="number" name="cant_notas" min = "0" placeholder = "<?php echo $cant_nota_anterior ?>">

                                        <input type="submit" name="boton" value="Cambiar">

                                    </form>

                                    </div>

                                </div>

                            </tbody>

                </table>

            </div>

        <?php

        }

        ?>

</body>
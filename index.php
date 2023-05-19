<!-- Acordate que, al llamarse "index...", este será el archivo que abra el xampp automáticamente. Por eso, los archivos de inicios de sesión siempre se llaman index. -->

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

    <title>Iniciar sesión, docente</title>

    <style>

        body{

            background: black;

        }

    </style>

</head>

<body>

    <div class="conteiner text-center">

        <div class="row">

            <div class="col-12">

                <h1 style="color:red">Iniciar sesión</h1>

            </div>

        </div>

        <br>

        <div class="row">

            <div class="col-4">

                &nbsp;

            </div>

            <div class="col-4">

                <form action="../acc/acc_guardar_curso.php" method="POST">
            
                    <div class="form-group">

                        <label for="usuario"><h2 style="color:purple">Usuario</h2></label>
                        <br>
                        <input type="text" required name="usuario" placeholder="EJ: Pepe">
                    
                    </div>

                    <div class="form-group">

                        <label for="pass"><h2 style="color:purple">Contraseña</h2></label>
                        <br>
                        <input type="password" required name="pass" placeholder="EJ: Pepe">
                        <!-- Acordate que si escribo type="password" la contraseña no será mostrada al momento de escribirla en la barra. -->
                    </div>

                    <button type="submit" class="btn btn-primary" name="boton">Iniciar sesión</button><br> <br>

                    </form>

            </div> <?php //div col de form ?>

            <div class="col-4">

                &nbsp;

            </div>

        </div> <?php //div de row ?>

        <div class="row">

            <div class="col-12">

                <h2 style="color:pink">Crear nuevo usuario</h2>
                <br>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="../acc/acc_nuevo_usuario.php" class="btn btn-success">Crear nuevo usuario</a></button>
                <!-- Es un vínculo. Gracias a la class btn, provista por Boostrap, parece un botón. Pero sigue siendo un vínculo que, al ahcer click, me reedirige a otro archivo. -->

            </div>

        </div>

    </div>

</body>

</html>

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


    <title>Crear usuario</title>

    <style>

        h1{
            
            color:pink;

        }    

        body{

            background:green;

        }

    </style>
</head>

<body>

    <div class = "conteiner text-center">

        <div class="row">

            <div class="col-12">

                <h1>Crear nuevo usuario</h1>

            </div>

        </div>

        <div class = "row">

            <div class="col-4">

                &nbsp;

            </div>

            <div class="col-4">

                <form action="../acc/acc_guardar_docente.php" method="POST">
                
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

                    <button type="submit" class="btn btn-primary" name="boton">Crear usuario</button><br> <br>

                </form>
                
                <a href="../index.php"><img src="../login.jpg" width="20%"></a>
                <!-- Con el atributo width modifico el tamaño de la imagen. -->

            </div>

            <div class="col-4">

                &nbsp;

            </div>

        </div>

    </div>

</body>

</html>

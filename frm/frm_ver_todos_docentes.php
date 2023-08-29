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
            include "../conexion.php";
            include "../barra.php";
            include "../alertas.php";
            include "../modal_editar.php";

            $sql ="SELECT * FROM docentes";
            $res = mysqli_query($link, $sql);

        ?>
        
        <div class="conteiner text-center">

            <div class="row"> <?php //Cada row es una fila. Una fila puede contener varias columnas (col). Pero, en total las columnas pueden ocupar 12 espacios por filas. ?>

                <div class="col-12"><hr><h1 style ="color: black"> Hola, administrador <?php echo $_SESSION["nombre"] ?>!</h1><hr></div>

            </div>

            <div class="row">

                <div class="col-12"> <hr><h1 style="color: green">Ver todos los docentes</h1><hr></div>

            </div>

            <div class="row">

                <div class="col-4">

                    &nbsp;

                </div>

                <div class="col-4">

                    <h6> Aquí podrás modificar las características de todos los docentes o eliminar sus cuentas, <?php echo $_SESSION["nombre"] ?>.</h6>

                </div>

                <div class="col-4">

                    &nbsp;

                </div>
            
            </div>

            <table class="table">

                <thead>

                    <tr>

                        <th scope = "col">ID del docente</th>
                        <th scope = "col">Nombre y apellido del docente</th>
                        <th scope = "col">Contraseña del docente</th>
                        <th scope = "col">Rol del docente</th>
                        <th scope = "col"><i class="bi bi-person-x-fill bg-danger">Eliminar</i>/ <i class="bi bi-brush-fill bg-warning">Editar</i></th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                        while ($fila = mysqli_fetch_array($res)){ //Mientras existan datos en $res, me los va a traer.

                    ?>

                            <tr>

                                <td> <?php echo $fila["docente_id"] ?> </td>

                                <td> <?php echo $fila["nombre"] ?> </td>

                                <td> <?php echo $fila["contraseña"] ?> </td>

                                <td> <?php if (($fila["rol_id"]) == 1){ //Si rol_id es igual a 1, significa que el docente es administrador; sino, es usuario.

                                                echo 'Administrador';

                                            }else{

                                                echo 'Usuario';

                                            } ?>
                                </td>

                                <td>

                                    <!-- -------------------------------------MODAL ELIMINAR------------------------------------------------ -->

                                    <div class="modal" tabindex="-1" id="modal_eliminar_docente">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title ">ATENCIÓN, administrador <?php echo $_SESSION["nombre"] ?>!!</h5> 
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>¿Está seguro de eliminar al docente <?php echo $fila["nombre"]?>?</p>
                                                    <p>Esta accion no se puede revertir.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id = "modal_eliminar_docente_docente">Eliminar docente</button>
                                                    
                                                    <!-- Si aprieto "Eliminar Partida", el botón, que es un vínculo con forma de botón, me reedirige a acc_borrar_cursos.php. -->
                                                </div>
                                            </div>
                                            </div>
                                        </div>


                            <!-- -------------------------------------FIN DEL MODAL ELIMINAR------------------------------------------------ -->
            

                                    <!-- Botón que abrirá el Modal de eliminar -->
                                    <button type="button" class="btn btn-danger boton_borrar_docente"  id="<?php echo $fila["docente_id"] ?>" data-toggle="modal_eliminar" data-target="#modal_eliminar_usuario<?php echo $fila["docente_id"]; ?>"><i class="bi bi-person-x-fill">Eliminar</i></button>  
                                    <!-- /////////////////////////////////// -->
                                    

                                    <!-- //////////////////BOTÓN QUE ABRE EL MODAL DE EDITAR////////////////// -->
                                    <button type="button" class="btn btn-warning boton_editar_docente" id="<?php echo $fila["docente_id"] ?>"><i class="bi bi-brush-fill bg-warning"></i></button>
                                    <!-- Me llevo vía url (GET) al docente_id para identificar qué dato debo editar. Es el botón que me abrirá el modal editar. El modal editar y el de eliminar los puse en un archivo aparte para que no se genere un choclo de código en el presente archivo.-->
                                    <!-- ////////////////////////FIN DEL BOTÓN QUE ABRE EL MODAL EDITAR EDITAR ////////////////////////////////////////////////// -->


                                </td>

                            </tr>

                    <?php

                        }

                    ?>

                </tbody>

            </table>

        </div> <?php //div conteiner ?>

        <script>

            $(document).ready(function(){//Sobre este documento, este archivo, cuando esté listo realizá las siguientes funciones o actividades:

                ////////////////Cambiemos las alertas para que desaparezcan después de unos segundos:
                $('.alert button').hide();

                setInterval(function(){
                    $('.alert').hide("slow");
                }, 3000); //Oculta las alertas luego de que pasen 3000 milisegundos (3 segundos).

                //////////////////////Vamos a eliminar al usuario, al docente, en un segundo plano, sin reedireccionamientos ni recargas de páginas:
                $('.boton_borrar_docente').click(function(){ //Cuando hagas click (click) sobre el elemento cuya clase (.) es boton_borrar_docente, hacé la siguiente función o actividad:

                    var docente_id = this.id; //Primero, creame una variable (var) llamada docente_id cuyo valor sea el id (.id) del último elemento seleccionado (this). En mi caso, el último elemento seleccionado es aquel cuya clase es boton_borrar_docente.

                    var entorno = this; //También creame una variable (var) llamada entorno cuyo valorsea el id de docente_id porque fue el último elemento seleccionado (this). Eso servirá en el último paso de eliminar a un docente.

                    $('#modal_eliminar_docente').modal("show"); //Luego de crearme las variables docente_id y entorno con sus respectivos valores, quiero que me muestres (show) el modal (modal) cuyo id (#) sea modal_eliminar_docente.

                    $("#modal_eliminar_docente_docente").click(function(){ //Si hago click en el elemento cuyo id (#) es modal_eliminar_docente_docente (Que es el botoncito de eliminar docente dentro del modal), haceme la siguiente función:

                        $.get("../acc/acc_eliminar_docente.php", {docente_id : docente_id}, function(data){ //Andá a acc_eliminar_docente.php (en segundo plano, obvio), y llevate la variable docente_id con el valor de la variable que cree al inicio de js docente_id. Así, el programa sabe qué docente eliminar en acc_eliminar_docente.php


                        }, "json")

                        $("#modal_eliminar_docente").modal("hide"); //Una vez que fuiste a acc_eliminar_docente.php, por lo que el docente ya fue eliminado, ocultame (hide) el modal.
                        $(entorno).closest("tr").remove(); //Finalmente, eliminame (remove) la fila (tr) que contiene a usuario_id (valor guardadito en la variable entorno). A su vez, para que no sea necesario recargar la página para ver desaparecida a la fila, utilizo la función cosest para que me oculte la fila.

                    })

                })


                //////////////Editemos al docente en un segundo plano/////////////////////////////
          //A diferencia de proyectos anteriores míos, está vez el código de edición en segundo plano lo hice de forma más prolija. Dividí los pasos en funciones. Sino, quedaba un choclo de código medio inentendible.  

            $(document).ready(function() { //En el presente documento (document) cuando esté listo (ready) haceme las siguietes funciones o actividades:

                $(".boton_editar_docente").click(function() { //Cuando haga click (click) en el elemento (yo no sé que es un botón) cuya clase (.) es boton_editar_docente, haceme la siguiente función 

                    var docente_id = this.id; //Le asigno a la variable docente_id el valor del id del elemento (el programa no sabe que es un botón) cuya clase (.) es boton_editar_docente.

                // console.log(docente_id); //Todos los consol.log es para ver el funcionamiento en la consola de JS. No afecta al programa. 

                    obtenerDatosDocente(docente_id); //Envío a la función obtenerDatosDocente con la variable docente_id como parámetro. La función no me retorna nada.

                    $('#modal_editar_docente').modal("show"); //Mostrame (show) el modal (modal) cuyo id es modal_editar_docente.

                });

                $("#modal_editar_docente_guardar").click(function(e){ //Cuando haga click (click) en el elemento cuyo id (#) es modal_editar_docente_guardar, haceme la siguiente función o actividad (function).

                    e.preventDefault(); //Método de JS que evita a toda costa que haya un reedireccionamiento de página. Es por las dudas. Así, por más que en un archivo haya un href, gracias a este método no habrá reedireccionamiento.

                    var docente_id = $("#modal_editar_docente_id").val(); //Este fragmento de código recupera el ID de un elemento con el id modal_editar_docente_id. Cuando recuperé los datos del docente en acc_datos_docente.php almacené el id en este form para recuperarlo en este momento y que el programa sepa a qué docente editar. 

                    var nombre = $("#modal_editar_docente_docente").val(); //A la variable nombre le asigno el valor que se halla en el elemento cuyo id es modal_editar_docente_docente. Y así con cada uno. 

                    var contraseña = $("#modal_editar_docente_pass").val();

                    var rol_id = $("#modal_editar_docente_rol").val();
            /*
                    console.log(nombre); 
                    console.log(contraseña);
                    console.log(rol_id);
            */
                    actualizarDatosDocente(docente_id, nombre, contraseña, rol_id); //Le envío a la función actualizarDatosDocente cuatro variables como parámetro. No me retorna nada.

                    $('#modal_editar_docente').modal("hide"); //Finalmente, el programa oculta (hide) el modal(modal) cuyo id(#) es modal_editar_docente.

                });

            });


            })

            function obtenerDatosDocente(docente_id) { //En esta función obtengo todos los datos del docente cuyo ID es igual a docente_id. Esos datos aparecerán en el modal editar para que el usuario vea cuáles son los valores que eligió en un principio.

                $.get("../acc/acc_datos_docente.php", {docente_id: docente_id}, function(data){//Va en segundo plano al archivo acc_datos_docente.php. De allí obtiene los datos del docente y los almacena en la variable data.
                // console.log(data);

                    $("#modal_editar_docente_id").val(data.docente_id); //En el form cuya id es modal_editar_docente_id le asigno el valor que almacené en la variable docente_id que me traje como parámetro. De esta manera, al hacer click en guardar se enviará a acc_editar_docente_segundoplano.php la variable guardada en este id y el programa sabrá a qué docente editar.

                    $("#modal_editar_docente_docente").val(data.nombre); //En el id (#) modal_editar_docente_docente aparecerá como valor (val) el valor de data.nombre. Así, el usuario sabrá cuál es el valor original de nombre. Lo mismo con los otros datos.

                    $("#modal_editar_docente_pass").val(data.contraseña); //Acá, finalmente, traigo el valor de contraseña y lo asigno al elemento del modal cuyo id es modal_editar_docente_pass. 

                    $("#modal_editar_docente_rol option[value='"+data.rol_id+"']").prop("selected", true);

                }, "json");

            }

            function actualizarDatosDocente(docente_id, nombre, contraseña, rol_id) {  

                $.get("../acc/acc_editar_docente_segundoplano.php", {

                    docente_id: docente_id,

                    contraseña: contraseña,

                    nombre: nombre,

                    rol_id: rol_id
                    
                }, function(data){

                // console.log(docente_id);
                }, "json");

            }

        </script>

    </body>
</html>
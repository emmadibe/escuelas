<?php

    include "../conexion.php";
    include "../clases/mail.php";

    if(!isset($_POST["usuario"]) AND
        (!isset($_POST["pass"]))){

            header("location:../frm/frm_crear_docente.php?INFORMACION=NO_DOCENTE");

    }else{

            $usuario = $_POST["usuario"];
            $pass = $_POST["pass"];
            $pass2 = $_POST["pass2"];
            $email = $_POST["email"];

            if($pass != $pass2){

                header("location:../frm/frm_crear_docente.php?INFORMACION=NO_IGUALES");

            }else{

                $sql = "INSERT INTO docentes (nombre,
                                                contraseña,
                                                email,
                                                rol_id)
                                                
                                            VALUES('".$usuario."',
                                                    '".$pass."',
                                                    '".$email."',
                                                    2)";

                //Al rol_id le asigno 2 (usuario común) ya que los administradores (rol_id = 1) suelen crearse desde la base de datos misma.

                $res = mysqli_query($link, $sql);
                
                if($res){

                    header("location:../index.php?INFORMACION=DOCENTE_EXITO");

                }else{

                    header("location:../frm/frm_crear_docente.php?INFORMACION=DOCENTE_FRACASO");

                }

                    //////////////////Ahora vamos a escribir un string grandote que vamos a enviarle a nuestro usuario.

                    $body = 'Hola %s,<br>
                    
                    Has creado tu usuario correctamente, tu información es la siguiente: <br><br>
                    <b> Nombre(s): </b> %s<br>
                    <b> Email: </b> %s<br>
                    <b> rol: </b> %s<br>
                    <b> fecha: </b> %s<br>

                    ';

                $body = sprintf($body, $usuario, $email, format_date($fecha)); //COn la función sprintf transformamos los placeholder(%s) con los valores que corresponden

             
                //Imprimimos este mensaje: 

                echo $body;

                //////////////////////////////////Enviar el correo electrónico: 

                
                $destino = $email;
         
                $contenido = $body;

                mail($destino, "Cotizacion", $contenido);

                mail();

                header("Location: index.html");
                
                
        }

    }


?>
<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/src/Exception.php';


    $mail = new PHPMailer(true); //Creo una instancia de la clase PHPMailer. Recordar que con la palabra clave new creo una instancia (un objeto) de una clase. Esa nueva instancia, ese nuevo objeto de la clase PHPMailer, se llama $email.


    //Configure los parámetros del correo, como el servidor SMTP, el puerto, el nombre de usuario y la contraseña:
    try {
        //Server settings
        $mail->SMTPDebug = 0; //Es para ver los debug (erores). Con 0 como valor lo desactivo.                     //Enable verbose debug output
        $mail->isSMTP();         //Es el protocolo que usamos para enviar el mail.                                   //Send using SMTP
        $mail->Host       = 'smtp.live.com';       //En host debemos escribir el server del servicio de correo que vamos a usar.              //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'emmadibe33@hotmail.com';        //En usuario y contraseña debo escribir el usuario y contraseña de la cuenta de correo que se envían los mail. Pues, PHPMailer va a acceder a esa cuenta y desde esa cuenta va a enviar el correo.             //SMTP username
        $mail->Password   = 'Ifoundaway333';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Configure los detalles del remitente y del destinatario:
        //Recipients
        $mail->setFrom('emmadibe33@hotmail.com', 'Xardas'); //El correo se debe enviar desde el mail que puse en mail->username. El segundo parámetro es mi nombre.
        $mail->addAddress('emmadibe33@gmail.com', 'Joe User');     //Add a recipient //A quién se lo envía el correo.
        $mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');

        //Attachments //Esto es para enviar archivos como imágenes
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    

    //Configure el asunto y el cuerpo del correo:
        //Content
        $mail->isHTML(true);                //Esto es para que lo que envíe por correo acepte html.                  //Set email format to HTML
        $mail->Subject = 'Here is the subject'; //Asunto
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>'; //Cuerpo del correo
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';

    } catch (Exception $e) {

        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

    }



?>
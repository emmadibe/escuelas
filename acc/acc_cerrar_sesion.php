<?php

    SESSION_START();

    SESSION_DESTROY(); //Destruye las variables. Es para cerrar sesión.

    header("location:../index.php"); //Me redirige automáticamente a la página de inicio de sesión.

?>
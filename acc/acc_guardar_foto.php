<?php
include "../conexion.php";

$docente_id = $_GET["docente_id"];

// Obtener el nombre y la ubicación temporal del archivo subido
$imagen_nombre = $_FILES["foto"]["name"];
$imagen_temporal = $_FILES["foto"]["tmp_name"];

// Leer el contenido de la imagen en un string binario
$contenido_imagen = file_get_contents($imagen_temporal);

// Preparar la consulta SQL para insertar la imagen en la base de datos
$sql = "UPDATE docentes SET foto_perfil = ?,
                            nombre_foto = ?

                            WHERE docente_id = ?"; 
$stmt = mysqli_prepare($link, $sql);

// Vincular los parámetros de la consulta con los valores de la imagen
mysqli_stmt_bind_param($stmt, "sss", $imagen_nombre, $imagen_nombre, $docente_id);

// Ejecutar la consulta
$resultado = mysqli_stmt_execute($stmt);

if ($resultado) {
    header("Location:../frm/frm_cursos.php?INFORMACION=FOTO_EXITO");
} else {
    header("Location:../frm/frm_cursos.php?INFORMACION=FOTO_FRACASO");
}

// Cerrar la conexión y liberar recursos
mysqli_stmt_close($stmt);
mysqli_close($link);
?>

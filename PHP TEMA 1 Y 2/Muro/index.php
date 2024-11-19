<?php
//? Recuperamos o creamos la sesion
session_start();

//? Establecemos una variable con el directorio de las vistas
$ruta = "vistas" . DIRECTORY_SEPARATOR;

if (isset($_SESSION["usuario"])) {
    $usuarioVisto = isset($_GET['ver']) ? $_GET['ver'] : $_SESSION["usuario"];
    $vista = "home.php";
} else {
    $vista = "identificacion.php";
}

//? Incluimos los controladores y las funciones
require("modelo" . DIRECTORY_SEPARATOR . "funciones.php");
require("controlador" . DIRECTORY_SEPARATOR . "controlUser.php");
require("controlador" . DIRECTORY_SEPARATOR . "controlMuro.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muro | App</title>
    <link rel="shortcut icon" href="./css/img/home_fav.svg" type="image/x-icon">
    <link rel="stylesheet" href="./css/estilos.css">
</head>

<body>
    <main>
        <?php include $ruta . "mensajes.php"; ?>
        <?php require $ruta . $vista; ?>
    </main>
</body>

</html>
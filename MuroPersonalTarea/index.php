<?php
session_start();

// Establecemos la variable con el directorio de las vistas
$ruta = "vistas" . DIRECTORY_SEPARATOR;
$vista = isset($_SESSION["usuario"]) ? "muro.php" : "identificacion.php";

// Incluimos las funciones y controladores
require("modelo" . DIRECTORY_SEPARATOR . "funciones.php");
require("control" . DIRECTORY_SEPARATOR . "inicioSesion.php");
require("control" . DIRECTORY_SEPARATOR . "paginaPrincipal.php");

// Si el usuario está autenticado y se especifica un usuario en la URL, mostrar ese muro
if (isset($_SESSION["usuario"]) && isset($_GET["usuario"])) {
    $vista = "muro.php";
}

?>

<html>

<head>
    <title>Red Social</title>
</head>

<body style="background-color: grey">
    <?php
    $mensaje = $_SESSION["mensaje"] ?? "";
    unset($_SESSION["mensaje"]);

    echo $mensaje
        ?>

    <br><br>

    <?php require $ruta . $vista; ?>
    </bodysty>

</html>
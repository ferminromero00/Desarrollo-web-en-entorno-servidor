<?php
session_start();

// Establecemos la variable con el directorio de las vistas
$ruta = "vistas" . DIRECTORY_SEPARATOR;
$vista = isset($_SESSION["usuario"]) ? "PaginaPrincipal.php" : "identificacion.php";

// Incluimos las funciones y controladores
require("modelo" . DIRECTORY_SEPARATOR . "funciones.php");
require("control" . DIRECTORY_SEPARATOR . "usuariosControlador.php");
require("control" . DIRECTORY_SEPARATOR . "paginaControlador.php");

// Si el usuario está autenticado y se especifica un usuario en la URL, mostrar ese muro
if (isset($_SESSION["usuario"]) && isset($_GET["usuario"])) {
    $vista = "paginaPrincipal.php";
}

?>

<html>

<head>
    <title>Red Social</title>
</head>

<body>
    <?php
    $mensaje = $_SESSION["mensaje"] ?? "";
    unset($_SESSION["mensaje"]);
    ?>
    <?php require $ruta . $vista; ?>
</body>

</html>
<?php

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}
require("vistas" . DIRECTORY_SEPARATOR . "rutapublicaciones.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal</title>
    <style>
        <?php include "style2.css"; ?>
        <?php include "style3.css"; ?>
    </style>
</head>

<body>
    <!--Mensaje de bienvenida para el usuario y indicador de en que muro se encuentra-->
    <?php require("vistas" . DIRECTORY_SEPARATOR . "bienvenidaUsuario.php"); ?>

    <!--Poder publicar, comentar, ver usuarios online, y visualizar todo eso en este controlador-->
    <?php require("vistas" . DIRECTORY_SEPARATOR . "publicacionRespuestas.php"); ?>

    <form method="POST"><input type="submit" value="Cerrar_Sesion" name="accion"></form>
</body>

</html>
<?php

session_start();

require("modelo" . DIRECTORY_SEPARATOR . "funciones.php");
require("control" . DIRECTORY_SEPARATOR . "controladorSesion.php");


if (isset($_SESSION["usuario"])) {
    $vista = "vistas" . DIRECTORY_SEPARATOR . "pagPrincipal.php";
} else {
    $vista = "vistas" . DIRECTORY_SEPARATOR . "inicioSesion.php";
}




require $vista;
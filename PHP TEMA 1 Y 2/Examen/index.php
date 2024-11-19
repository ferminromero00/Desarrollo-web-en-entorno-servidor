<?php
// Inicia la sesión para el manejo de usuarios autenticados
session_start();

$vista = "vistas" . DIRECTORY_SEPARATOR . "iniciosesion.php";

require("control" . DIRECTORY_SEPARATOR . "iniciarSesion.php");
require("modelo" . DIRECTORY_SEPARATOR . "funciones.php");


require $vista;






?>
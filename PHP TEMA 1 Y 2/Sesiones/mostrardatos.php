<?php
session_start();
$nombre = $_SESSION["nombre"];
$apellidos = $_SESSION["apellidos"];

echo "Hola $nombre $apellidos";

?>
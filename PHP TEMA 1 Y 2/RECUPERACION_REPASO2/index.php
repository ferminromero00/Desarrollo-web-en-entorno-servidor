<?php
session_start();

require("modelo/funciones.php");
require('controlador/controlador.php');

if (!isset($_SESSION["usuario"])) {
    $vista = "acceso.php";
}



?>

<div><?php include('vistas/alertas.php') ?></div>
<div><?php include("vistas/$vista") ?> </div>
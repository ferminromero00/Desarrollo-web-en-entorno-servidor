<?php
// Recuperamos o creamos la sesión
session_start();
// Establecemos una variable con el directorio de la vistas
$ruta = "vistas".DIRECTORY_SEPARATOR;
// Establecemos la vista predeterminada que corresponda en función de si el usuario se ha identificado o no.
if (isset($_SESSION["usuario"])) {
    $vista = "blocdenotas.php"; 
}else{
    $vista = "identificacion.php"; 
}

// Incluimos las funciones
require ("modelo".DIRECTORY_SEPARATOR."funciones.php");
// Incluimos los controladores
require ("controladores".DIRECTORY_SEPARATOR."controladorUsuarios.php");
require ("controladores".DIRECTORY_SEPARATOR."controladorBloc.php");



?>

<!-- Mostramos la página con la vista correspondiente -->

<html>
    <head>
        <title>Bloc de notas</title>
    </head>
    <body>
        <?php /* include menú */ ?>
        <!-- include porque no es tan grave no incluir un mensaje -->
        <?php include $ruta."mensajes.php" ?>
        <!-- Incluimos el contenido -->
        <?php require $ruta.$vista ?>
        <?php /* include pie de página */ ?>
    </body>
</html>


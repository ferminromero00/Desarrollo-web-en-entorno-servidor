<?php 
    session_start();
    
    require("modelo/funciones.php");
    require("controlador/controlador.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionarios</title>
</head>
<body>
    <div>
        <?php
            include('vistas/alertas.php');
        ?>
    </div>
    <div>
        <?php
            include("vistas/$vista");
        ?>
    </div>
    
</body>
</html>

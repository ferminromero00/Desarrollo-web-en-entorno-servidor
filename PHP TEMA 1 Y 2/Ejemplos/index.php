<?php
require_once('Controlador/controlador.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Mensajeria</title>
</head>
<body>
<div class="container mt-3">
    <?php 
        require_once("./Vistas/menu.html");
        require_once("./Vistas/modal.html");
        require_once("./Vistas/avisos.php");
        if (isset($vista)) require_once("./Vistas/".$vista);
        
    ?>
    </div>
</body>
<script>
    <?php if (!isset($_SESSION["usuario"])): ?>
        var modal = bootstrap.Modal.getOrCreateInstance(identificacion);
        modal.show();
    <?php endif; ?>
</script>
</html>


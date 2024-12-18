<?php
require ('control/controlador.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pon tu nombre aquí</title>
</head>
<body>
    <section>
        <?php require ('vistas/alertas.php') ?>
        <?php require ("vistas/$vista") ?>
    </section>
</body>
</html>
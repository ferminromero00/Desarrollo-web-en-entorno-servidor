<?php
// Iniciamos la sesión, si no existiera se crea
session_start();
// Guardamos en la sesión el nombre y apellidos de una persona
$_SESSION["nombre"] = "Pepito";
$_SESSION["apellidos"] = "Perez";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo básico de sesiones</title>
</head>
<body>
    <a href="mostrardatos.php">Mostrar los datos del usuario</a>
</body>
</html>
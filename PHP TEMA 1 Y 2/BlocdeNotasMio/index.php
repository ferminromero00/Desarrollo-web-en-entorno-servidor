<?php
// Separo la lógica en un fichero aparte
require_once("controladorUsuario.php");

if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identificación</title>
</head>

<body>
    <h4><?php if (isset($mensaje))
        echo $mensaje; ?></h4>
    <form>
        <label>Usuario</label>
        <input type="text" name="usuario" />
        <label>Clave</label>
        <input type="password" name="clave" />
        <input type="submit" name="accion" value="Acceder" />
        <input type="submit" name="accion" value="Registrarme" />
    </form>
</body>

</html>
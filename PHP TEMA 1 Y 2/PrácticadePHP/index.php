<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>

<body>

    <h4><?php if (isset($_GET["mensaje"])) echo $_GET["mensaje"]; ?></h4>

    <form action="iniciarSesionControlador.php" method="POST">
        <label for="usuario">Usuario: </label>
        <input type="text" name="user" id="usuario" required>
        <label for="password">Contraseña: </label>
        <input type="password" name="pass" id="password" required><br><br>

        <input type="submit" value="Acceder" name="accion">
        <input type="submit" value="Registrarte" name="accion">
        <input type="submit" value="Cerrar_sesion" name="accion">
      
    </form>

</body>

</html>

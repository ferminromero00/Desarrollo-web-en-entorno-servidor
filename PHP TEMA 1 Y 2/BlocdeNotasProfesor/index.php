<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identificación</title>
</head>
<body>
    <h4><?php 
            if (isset($_SESSION["mensaje"])) {
                // Muestro el mensaje 
                echo $_SESSION["mensaje"]; 
                // Elimino la variable de sesión
                unset($_SESSION["mensaje"]);
            }                
        ?>
    </h4>
    <form action="controladorUsuarios.php">
        <label>Usuario</label>
        <input type="text" name="usuario"/>
        <label>Clave</label>
        <input type="password" name="clave"/>
        <input type="submit" name="accion" value="Acceder"/>
        <input type="submit" name="accion" value="Registrarme"/>
    </form>
</body>
</html>
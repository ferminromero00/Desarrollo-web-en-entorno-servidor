<?php 
// Recuperamos la sesión y si no existe se crea automáticamente
session_start();

// Preguntamos si hemos pulsado el botón
if (isset($_REQUEST["accion"])) {
    session_unset();
    session_destroy();
    // Le enviamos al clciente un mensaje de redirección de manera que el cliente 
    // solicita al servidor la página actual $_SERVER["PHP_SELF"]
    // equivalente a header("Location: visitas1.php")
    // Es habitual header("Location: index.php") para ir a la página principal
    header("Location: ".$_SERVER['PHP_SELF']);
    

}

// Preguntamos si existe la variable de sesión 'visitas'
if (!isset($_SESSION["visitas"])) {
    // si no existe, la creamos y la inicializamos
    $_SESSION["visitas"] = 0;
}

// Recupero la variable de sesión visitas en otra variable
$visita = $_SESSION["visitas"];
// Incremento la variable visitas
$visita++;
// Y guardo de nuevo en la variable de sesión visitas el nuevo valor
$_SESSION["visitas"] = $visita;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contador de visitas individuales</title>
</head>
<body>
    <p>
        Es la visita número <?php echo $_SESSION["visitas"]; ?> 
        desde la dirección <?php echo $_SERVER["REMOTE_ADDR"] ?>
    </p>
    <form method="POST">
        <input type="submit" value="Cerrar sesión" name="accion" />
    </form>
</body>
</html>

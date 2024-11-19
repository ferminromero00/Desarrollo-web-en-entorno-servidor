<?php
session_start();

$usuario = $_SESSION["usuario"];
$contenido = "";
$nombre_fichero = "";

// Mostrar el mensaje de error o éxito si lo hay
if (isset($_GET["mensaje"])) {
    $mensaje = $_GET["mensaje"];
    echo "<h3>$mensaje</h3>";
}

// Mostrar el contenido del archivo si se ha abierto correctamente
if (isset($_SESSION["contenido"])) {
    $contenido = $_SESSION["contenido"];
}

// Mostrar el nombre del fichero si se ha abierto correctamente
if (isset($_SESSION["nombre_fichero"])) {
    $nombre_fichero = $_SESSION["nombre_fichero"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloc de Notas</title>
</head>

<body>
    <h3><?php echo "Bienvenido $usuario" ?></h3>

    <form action="blocdenotasControlador.php" method="POST">
        <div>
            <!-- Mostrar el contenido del archivo -->
            <textarea rows="10" cols="120" name="contenido"><?php echo $contenido; ?></textarea>
        </div>
        <label>Fichero</label>
        <input type="text" name="nombre_fichero" value="<?php echo $nombre_fichero; ?>" />
        <input type="submit" value="Abrir" name="accion" />
        <input type="submit" value="Guardar" name="accion" />
        <input type="submit" value="Imprimir en pdf" name="accion" />
        <input type="submit" value="Explorar" name="accion" />
        <input type="submit" value="Cerrar Sesion" name="accion" />
    </form>
</body>

</html>

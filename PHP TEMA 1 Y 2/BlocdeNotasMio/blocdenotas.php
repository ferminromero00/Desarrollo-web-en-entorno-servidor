<?php
session_start();
/* Si no existe la variable de sesión usuario, es porque la identificación no se 
 ha producido correctamente redirigimos a la página principal */
if (!isset($_SESSION["usuario"])) {
    header("Location:index.php");
}


// Incluimos el fichero con las funciones abrir, guardar, etc..
require_once('funciones.php');
// Inicializamos las variables
$contenido = "";
$nombre_fichero = "";
// Si hemos recibido el botón ....
if (isset($_REQUEST["accion"])) {
    // Convertimos a minúscula y eliminamos los espacios en blanco y 
    $accion = str_replace(" ", "", strtolower($_REQUEST["accion"]));
    // Recogemos el nombre del fichero y el contenido
    $nombre_fichero = $_REQUEST["nombre_fichero"];
    $contenido = $_REQUEST["contenido"];
    // Preguntamos por el botón que hemos pulsado    
    switch ($accion) {

        case "guardar": // Construimos la ruta y el nombre de fichero 
            $ruta = $_SESSION["usuario"] . DIRECTORY_SEPARATOR . $nombre_fichero;
            $ok = guardar($ruta, $contenido);
            if ($ok == false) {
                $mensaje = "No se ha podido guardar";
            } else {
                $mensaje = "El fichero se ha guardado correctamente";
            }
            break;

        case "abrir":   // Construimos la ruta y el nombre de fichero 
            $ruta = $_SESSION["usuario"] . DIRECTORY_SEPARATOR . $nombre_fichero;
            $contenido = abrir($ruta);
            if (!$contenido) {
                $mensaje = "No se ha podido abrir el archivo";
            }
            break;
        case "cerrarsesion": // Elimino las variables de sesión
            session_unset();
            // Destruyo la sesión
            session_destroy();
            // Y nos redirigimos a la página de login
            header("Location: index.php?mensaje=Se ha cerrado la sesión");            
            break;
    }
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
    <h4>
        <?php if (isset($mensaje))
            echo $mensaje ?>
        </h4>
        <form>
            <div>
                <textarea rows="10" cols="120" name="contenido"><?php echo $contenido; ?></textarea>
        </div>
        <label>Fichero</label>
        <input type="text" name="nombre_fichero" value="<?php echo $nombre_fichero; ?>" />
        <input type="submit" value="Abrir" name="accion" />
        <input type="submit" value="Guardar" name="accion" />
        <input type="submit" value="Imprimir en pdf" name="accion" />
        <input type="submit" value="Explorar" name="accion" />
        <input type="submit" value="Cerrar Sesion" name="accion" />

        <form>
</body>

</html>
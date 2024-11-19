<?php
session_start();
require_once("funciones.php");

if (isset($_POST["accion"])) {
    $accion = $_POST["accion"];

    // Recoger el nombre del fichero enviado por el formulario
    $nombre_fichero = isset($_POST["nombre_fichero"]) ? $_POST["nombre_fichero"] : '';

    // Recoger el contenido del textarea
    $contenido = isset($_POST["contenido"]) ? $_POST["contenido"] : '';

    // Ruta del archivo basado en el usuario
    $ruta = $_SESSION["usuario"] . DIRECTORY_SEPARATOR . $nombre_fichero;

    switch ($accion) {
        case "Abrir":
            // Intentar abrir el archivo
            $contenido = abrir($ruta);

            if ($contenido === false) {
                // Si no se puede abrir el archivo, redirigir con un mensaje de error
                $mensaje = "No se ha podido abrir el archivo o no existe.";
                header("Location: blocdenotas.php?mensaje=" . urlencode($mensaje));
            } else {
                // Guardar el contenido del archivo en una variable de sesión para mostrarlo
                $_SESSION["contenido"] = $contenido;
                $_SESSION["nombre_fichero"] = $nombre_fichero;
                header("Location: blocdenotas.php");
            }
            break;

        case "Guardar":
            // Intentar guardar el contenido en el archivo
            $ok = guardar($ruta, $contenido);
            
            if ($ok === false) {
                $mensaje = "No se ha podido guardar el fichero.";
            } else {
                $mensaje = "El fichero se ha guardado correctamente.";
            }
            header("Location: blocdenotas.php?mensaje=$mensaje");
            break;

        // Otros casos como imprimir, explorar, etc.
        // ...
    }
}
?>

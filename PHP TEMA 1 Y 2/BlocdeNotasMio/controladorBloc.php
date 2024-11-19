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
    $accion = str_replace(" ","", strtolower($_REQUEST["accion"]));
    // Recogemos el nombre del fichero y el contenido
    $nombre_fichero = $_REQUEST["nombre_fichero"];
    $contenido = $_REQUEST["contenido"];
    // Preguntamos por el botón que hemos pulsado    
    switch ($accion) {

        case "guardar": // Construimos la ruta y el nombre de fichero 
                        $ruta = $_SESSION["usuario"].DIRECTORY_SEPARATOR.$nombre_fichero;
                        $ok = guardar($ruta, $contenido); 
                        if ($ok == false) {
                            $_SESSION["mensaje"] = "No se ha podido guardar el fichero $ruta";
                        }else{
                            $_SESSION["mensaje"] = "El fichero $ruta se ha guardado correctamente";
                        }
                        $_SESSION["contenido"] = $contenido;
                        $_SESSION["nombre_fichero"] = $nombre_fichero;
                        header("Location: blocdenotas.php");
                        break;

        case "abrir":   // Construimos la ruta y el nombre de fichero 
                        $ruta = $_SESSION["usuario"].DIRECTORY_SEPARATOR.$nombre_fichero;
                        $contenido = abrir($ruta);
                        if (!$contenido) {
                            // Dejamos un mensaje de aviso
                            $_SESSION["mensaje"] = "No se ha podido abrir el archivo $ruta";
                        }else{
                            // Guardamos el contenido en la sesión 
                            $_SESSION["contenido"] = $contenido;
                            $_SESSION["nombre_fichero"] = $nombre_fichero;
                        }
                        // De cualquier forma redirigimos al bloc de notas
                        header("Location: blocdenotas.php");
                        break; 
        case "explorar": $ruta = $_SESSION["usuario"];
                        $ficheros = scandir($ruta);
                        $_SESSION["ficheros"] = $ficheros;
                        header("Location: explorar.php");
                        break;
        
        case "imprimirenpdf": $fichero = $_REQUEST["nombre_fichero"];
                            imprimirPDF($fichero);
                            break;

        case "descargar": descargar($nombre_fichero);

                            break;

        
    }
}

?>
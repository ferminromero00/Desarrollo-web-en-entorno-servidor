<?php
$nombre_fichero = "";
$contenido = "";
if (isset($_REQUEST["accionMuro"])) {
    // Convetimos a minúscula y eliminamos los espacios
    $accion = str_replace(" ", "", strtolower($_REQUEST["accionMuro"]));


    switch ($accion) {
        case "publicar":
            $nombre_fichero = date("U");
            // Construimos la ruta y el nombre de fichero 
            $path = "usuarios" . DIRECTORY_SEPARATOR . $_SESSION["usuario"] . DIRECTORY_SEPARATOR . $nombre_fichero . ".txt";
            // Guardamos el contenido en el fichero que indique $path
            $ok = guardar($path, $_REQUEST["publicacion"]);
            // comprobamos si hemos podido guardar y emitimos el mensaje correspondiente
            if ($ok == false) {
                $mensaje = "No se ha podido publicar $path";
            } else {
                $mensaje = "$path se ha publicado correctamente";
            }

            // Establecemos la vista adecuada
            $vista = "home.php";
            break;
        case "eliminar":
            $nombre_fichero = $_REQUEST["fichero"];
            $path = "usuarios" . DIRECTORY_SEPARATOR . $_SESSION["usuario"] . DIRECTORY_SEPARATOR . $nombre_fichero;
            if (file_exists($path)) {
                unlink($path);
                $mensaje = "La publicacion se ha borrado";
            } else {
                $mensaje = "No existe la publicacion";
            }
            $vista = "home.php";
            break;
        case "responder":
            $fichero = $_REQUEST["fichero"];
            $contenido = file_get_contents("usuarios" . DIRECTORY_SEPARATOR . $usuarioVisto . DIRECTORY_SEPARATOR . $fichero);
            $vista = "responder.php";
            break;
        case "cancelar":
            $vista = "home.php";
            break;
        case "aceptar":
            $usuarioVisto = $_REQUEST["usuarioVisto"];
            $nombre_fichero = $_REQUEST["fichero"];
            $fichero = "usuarios" . DIRECTORY_SEPARATOR . $usuarioVisto . DIRECTORY_SEPARATOR . $nombre_fichero;
            $segundos = date("U");
            $fechaFormat = date('d-m-Y', $segundos);
            $respuesta = "\n" . $_REQUEST["respuesta"] . " - " . $_SESSION["usuario"] . " - " . $fechaFormat;
            $ok = editar($fichero, $respuesta);
            if ($ok == false) {
                $mensaje = "No se ha podido agregar el comentario.";
            } else {
                $mensaje = "Se ha agregado el comentario.";
            }
            /* $vista = "home.php"; */
            header("Location: index.php?ver=$usuarioVisto");
            break;
    }
}

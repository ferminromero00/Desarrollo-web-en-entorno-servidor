<?php

if (isset($_REQUEST["accionPag"])) {
    $accion = str_replace(" ", "", strtolower($_REQUEST["accionPag"]));
    if ($accion == "publicar") {
        $contenido = $_REQUEST["muro"];
        $usuario = $_SESSION["usuario"];
        $nombreArchivo = date("U");
        $rutaCarpeta = "usuarios/$usuario/$nombreArchivo";

        if (!is_dir($rutaCarpeta)) {
            mkdir($rutaCarpeta, 0777, true);
        }

        $rutaPublicacion = "$rutaCarpeta/$nombreArchivo.txt";

        if (!empty($contenido)) {
            $horaPublicacion = date("H:i:s"); // Obtener la hora de la publicación
            $contenidoCompleto = "[$horaPublicacion] $contenido"; // Añadir la hora al contenido
            file_put_contents($rutaPublicacion, $contenidoCompleto);
            $_SESSION["mensaje1"] = "Publicación realizada con éxito.";
        } else {
            $_SESSION["mensaje1"] = "No se puede publicar un mensaje vacío.";
        }

        header("Location: index.php?usuario=" . $usuario);
        exit();
    }
}

if (isset($_POST['respuesta']) && isset($_POST['ruta_publicacion'])) {
    $respuesta = $_POST['respuesta'];
    $ruta_publicacion = $_POST['ruta_publicacion'];
    $usuario = $_SESSION["usuario"];
    $usuario_muro = $_GET["usuario"] ?? $usuario;

    $nombreRespuesta = date("U") . "_" . uniqid();
    $ruta_respuesta = str_replace('.txt', "_$nombreRespuesta.docx", $ruta_publicacion);

    if (!empty($respuesta)) {
        $contenidoRespuesta = "Comentario de $usuario: \"$respuesta\"";
        file_put_contents($ruta_respuesta, $contenidoRespuesta);
        $_SESSION["mensaje1"] = "Respuesta enviada con éxito.";
    } else {
        $_SESSION["mensaje1"] = "No se puede enviar una respuesta vacía.";
    }

    header("Location: index.php?usuario=" . $usuario_muro);
    exit();
}

if (isset($_POST['eliminar_publicacion'])) {
    $ruta_publicacion = $_POST['ruta_publicacion'];
    eliminarPublicacion($ruta_publicacion);
}

if (isset($_POST['eliminar_respuesta'])) {
    $ruta_respuesta = $_POST['ruta_respuesta'];
    eliminarRespuesta($ruta_respuesta);
}

if (isset($_GET["usuario"])) {
    $usuario_muro = $_GET["usuario"];
    if (existe($usuario_muro)) {
        $vista = "PaginaPrincipal.php";
    } else {
        $_SESSION["mensaje"] = "El usuario no existe";
        header("Location: index.php");
        exit();
    }
}

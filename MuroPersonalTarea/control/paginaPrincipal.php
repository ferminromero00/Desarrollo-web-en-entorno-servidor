<?php
if (isset($_REQUEST["accionPagina"])) {
    $accion = str_replace(" ", "", strtolower($_REQUEST["accionPagina"]));

    switch ($accion) {
        case "publicar":
            $publicacion = publicar($_REQUEST["contenido"]);

            if ($publicacion) {
                $_SESSION["mensaje"] = "Publicacion registrada con exito";
            } else {
                $_SESSION["mensaje"] = "No se ha podido subir la publicacion";
            }
            header("Location: index.php");
            exit();

        case "borrar":
            if (isset($_POST["borrar_id"])) {
                borrarPublicacion($_POST["borrar_id"]);
                $_SESSION["mensaje"] = "Publicación borrada con éxito";
            } else {
                $_SESSION["mensaje"] = "Error al intentar borrar la publicación";
            }
            header("Location: index.php");
            exit();
        case "comentar":
            if (isset($_POST["comentario"]) && isset($_POST["comentario_id"]) && isset($_POST["usuario_visto"])) {
                $comentario = $_POST["comentario"];
                $idPublicacion = $_POST["comentario_id"];
                $usuarioVisto = $_POST["usuario_visto"];
                agregarComentario($idPublicacion, $comentario, $usuarioVisto);
                $_SESSION["mensaje"] = "Comentario añadido con éxito";
            } else {
                $_SESSION["mensaje"] = "Error al añadir el comentario";
            }
            header("Location: index.php?usuario=$usuarioVisto");
            exit();

    }
}
?>
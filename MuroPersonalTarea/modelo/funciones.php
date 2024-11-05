<?php

function registrar($usuario, $contraseña)
{
    $ok = false;

    $fecha = date("Y-m-d H:i:s");

    if (!is_dir("usuarios/$usuario")) {
        mkdir("usuarios/$usuario"); // Crear el directorio
    }

    $f = fopen("usuarios/usuarios.ini", "a+");

    if ($f != NULL) {
        $ok = fwrite($f, "$usuario=$contraseña" . PHP_EOL);
        fclose($f);
    }

    $f2 = fopen("registros.log", "a+");
    if ($f2 != NULL) {
        fwrite($f2, "Fecha: [$fecha] . El usuario $usuario se ha registrado" . PHP_EOL);
        fclose($f2);
    }


    return $ok;
}

function comprobacion($usuario, $contraseña)
{
    $ok = false;
    $usuarios = parse_ini_file("usuarios/usuarios.ini");

    if (isset($usuarios[$usuario])) {
        if ($usuarios[$usuario] === $contraseña) {
            $ok = true;
        }
    }
    return $ok;
}

function publicar($contenido)
{
    $usuario = $_SESSION["usuario"];
    $contador = 1;
    $directorio = "usuarios/$usuario/";

    $publicacion = $directorio . "publicacion$contador";
    while (is_dir($publicacion)) {
        $contador++;
        $publicacion = $directorio . "publicacion$contador";
    }

    mkdir($publicacion);

    $ruta = $publicacion . "/publicacion$contador.txt";
    $fecha = date("Y-m-d H:i:s"); // Obtener la fecha actual

    $f2 = fopen("registros.log", "a+");
    if ($f2 != NULL) {
        fwrite($f2, "Fecha: [$fecha] . El usuario $usuario ha subido una publicacion a su muro" . PHP_EOL);
        fclose($f2);
    }

    $f = fopen($ruta, "w");
    if ($f) {
        // Escribimos la fecha y el contenido en el archivo
        fwrite($f, "Fecha: $fecha" . PHP_EOL);
        fwrite($f, "Contenido: $contenido" . PHP_EOL);
        fclose($f);
        return true;
    } else {
        return false;
    }


}

function borrarPublicacion($id)
{
    $usuario = $_SESSION["usuario"];
    $directorio = "usuarios/$usuario/publicacion$id";

    $fecha = date("Y-m-d H:i:s");

    $f2 = fopen("registros.log", "a+");
    if ($f2 != NULL) {
        fwrite($f2, "Fecha: [$fecha] . El usuario $usuario ha borrado una publicacion de su muro" . PHP_EOL);
        fclose($f2);
    }

    // Borrar el directorio y su contenido
    if (is_dir($directorio)) {
        array_map('unlink', glob("$directorio/*.*"));
        rmdir($directorio);
        return true;
    }

    return false;
}

function agregarComentario($idPublicacion, $comentario, $usuarioVisto)
{
    $usuario = $_SESSION["usuario"]; // Commenting user
    $directorio = "usuarios/$usuarioVisto/";
    $rutaComentarios = $directorio . "publicacion$idPublicacion/comentarios.txt";

    $fecha = date("Y-m-d H:i:s");

    $f2 = fopen("registros.log", "a+");
    if ($f2 != NULL) {
        if ($usuario === $usuarioVisto) {
            fwrite($f2, "Fecha: [$fecha] . El usuario $usuario ha hecho un comentario en su propio muro" . PHP_EOL);
        } else {
            fwrite($f2, "Fecha: [$fecha] . El usuario $usuario ha hecho un comentario en el muro de $usuarioVisto" . PHP_EOL);
        }
        fclose($f2);
    }


    $f = fopen($rutaComentarios, "a");
    if ($f) {
        fwrite($f, "$usuario: $comentario" . PHP_EOL);
        fclose($f);
        return true;
    }
    return false;
}


function mostrarPublicaciones($usuario)
{
    $directorio = "usuarios/$usuario/";
    $contador = 1;
    $publicaciones = []; // Array para almacenar publicaciones

    while (is_dir($directorio . "publicacion$contador")) {
        $archivoPublicacion = $directorio . "publicacion$contador/publicacion$contador.txt";
        $rutaComentarios = $directorio . "publicacion$contador/comentarios.txt";

        if (file_exists($archivoPublicacion)) {
            $contenidoArchivo = file($archivoPublicacion, FILE_IGNORE_NEW_LINES);
            $fecha = isset($contenidoArchivo[0]) ? $contenidoArchivo[0] : '';
            $contenido = isset($contenidoArchivo[1]) ? $contenidoArchivo[1] : '';

            // Agregar la publicación al array
            $publicaciones[] = [
                'fecha' => $fecha,
                'contenido' => $contenido,
                'id' => $contador,
                'rutaComentarios' => $rutaComentarios
            ];
        }
        $contador++;
    }

    return $publicaciones; // Retornar las publicaciones
}

function obtenerUsuarios()
{
    return array_keys(parse_ini_file("usuarios/usuarios.ini"));
}






?>
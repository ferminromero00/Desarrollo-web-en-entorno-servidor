<?php

function existe($usuario)
{
    $ok = NULL;
    $usuarios = parse_ini_file("usuarios/usuarios.ini");

    if (isset($usuarios[$usuario])) {
        $ok = $usuarios[$usuario];
    }
    return $ok;
}

function acceder($usuario, $clave)
{
    $ok = false;
    $clave_usuario = existe($usuario);

    if ($clave_usuario != NULL && $clave_usuario == $clave) {
        $ok = true;
    }
    return $ok;
}

function grabar($usuario, $clave)
{
    $ok = false;
    $f = fopen("usuarios/usuarios.ini", "a+");

    if ($f != NULL) {
        $ok = fwrite($f, "$usuario=$clave" . PHP_EOL); // ok tomará el valor false si no se ha podido grabar
        fclose($f);
    }
    return $ok;
}

function registrar($usuario, $clave)
{
    $ok = false;
    if (!existe($usuario)) {
        $ok = grabar($usuario, $clave);

        if ($ok) {
            $ruta_usuario = "usuarios/" . $usuario;
            $ok = mkdir($ruta_usuario, 0777, true);
        }
    }
    return $ok;
}


function abrir($nombre_fichero)
{
    if (file_exists($nombre_fichero)) {
        return file_get_contents($nombre_fichero);
    } else {
        return ""; // Devuelve una cadena vacía si el archivo no existe
    }
}

function guardar($nombre_fichero, $contenido)
{
    // Crear el directorio si no existe
    $dir = dirname($nombre_fichero);
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    // Guardar el contenido en el archivo y devolver true/false
    return file_put_contents($nombre_fichero, $contenido) !== false;
}

function eliminarPublicacion($ruta_publicacion)
{
    if (file_exists($ruta_publicacion)) {
        array_map('unlink', glob(dirname($ruta_publicacion) . "/*")); // Elimina respuestas asociadas
        rmdir(dirname($ruta_publicacion)); // Elimina el directorio de la publicación
        $_SESSION["mensaje1"] = "Publicación eliminada con éxito.";
    } else {
        $_SESSION["mensaje1"] = "Error: La publicación no existe.";
    }
    header("Location: index.php");
    exit();
}

function eliminarRespuesta($ruta_respuesta)
{
    if (file_exists($ruta_respuesta)) {
        unlink($ruta_respuesta); // Elimina el archivo de respuesta
        $_SESSION["mensaje1"] = "Respuesta eliminada con éxito.";
    } else {
        $_SESSION["mensaje1"] = "Error: La respuesta no existe.";
    }
    header("Location: index.php");
    exit();
}
?>












?>
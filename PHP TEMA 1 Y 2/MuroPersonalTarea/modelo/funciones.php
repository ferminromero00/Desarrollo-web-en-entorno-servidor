<?php

// Función para registrar un nuevo usuario
function registrar($usuario, $contraseña)
{
    $ok = false;
    // Obtener la fecha actual
    $fecha = date("Y-m-d H:i:s");

    // Verificar si el directorio del usuario no existe y crearlo
    if (!is_dir("usuarios/$usuario")) {
        mkdir("usuarios/$usuario"); // Crear el directorio del usuario
    }

    // Abrir el archivo de usuarios en modo de escritura para agregar el nuevo usuario
    $f = fopen("usuarios/usuarios.ini", "a+");
    if ($f != NULL) {
        // Guardar usuario y contraseña en el archivo
        $ok = fwrite($f, "$usuario=$contraseña" . PHP_EOL);
        fclose($f);
    }

    // Registrar el evento de registro en un archivo de log
    $f2 = fopen("registros.log", "a+");
    if ($f2 != NULL) {
        fwrite($f2, "Fecha: [$fecha] . El usuario $usuario se ha registrado" . PHP_EOL);
        fclose($f2);
    }

    return $ok;
}

// Función para verificar las credenciales de inicio de sesión
function comprobacion($usuario, $contraseña)
{
    $ok = false;
    // Cargar los usuarios registrados
    $usuarios = parse_ini_file("usuarios/usuarios.ini");
    // Verificar si el usuario existe y si la contraseña coincide
    if (isset($usuarios[$usuario]) && $usuarios[$usuario] === $contraseña) {
        $ok = true;
    }

    return $ok;
}

// Función para publicar contenido en el muro del usuario
function publicar($contenido)
{
    $usuario = $_SESSION["usuario"];
    $contador = 1;
    $directorio = "usuarios/$usuario/";

    // Buscar el próximo número de publicación disponible
    $publicacion = $directorio . "publicacion$contador";
    while (is_dir($publicacion)) {
        $contador++;
        $publicacion = $directorio . "publicacion$contador";
    }

    mkdir($publicacion);

    $ruta = $publicacion . "/publicacion$contador.txt";
    $fecha = date("Y-m-d H:i:s");

    // Registrar el evento de publicación en un archivo de log
    $f2 = fopen("registros.log", "a+");
    if ($f2 != NULL) {
        fwrite($f2, "Fecha: [$fecha] . El usuario $usuario ha subido una publicacion a su muro" . PHP_EOL);
        fclose($f2);
    }

    // Crear el archivo de la publicación y escribir la fecha y contenido
    $f = fopen($ruta, "w");
    if ($f) {
        fwrite($f, "Fecha: $fecha" . PHP_EOL);
        fwrite($f, "Contenido: $contenido" . PHP_EOL);
        fclose($f);
        return true;
    }
    return false;
}

// Función para borrar una publicación de un usuario
function borrarPublicacion($id)
{
    $usuario = $_SESSION["usuario"];
    $directorio = "usuarios/$usuario/publicacion$id";

    $fecha = date("Y-m-d H:i:s");

    // Registrar el evento de borrado en un archivo de log
    $f2 = fopen("registros.log", "a+");
    if ($f2 != NULL) {
        fwrite($f2, "Fecha: [$fecha] . El usuario $usuario ha borrado una publicacion de su muro" . PHP_EOL);
        fclose($f2);
    }

    // Borrar el directorio de la publicación y sus archivos
    if (is_dir($directorio)) {

        array_map('unlink', glob("$directorio/*.*"));
        // Eliminar el directorio
        rmdir($directorio);
        return true;
    }

    return false;
}

// Función para agregar un comentario a una publicación de un usuario
function agregarComentario($idPublicacion, $comentario, $usuarioVisto)
{
    $usuario = $_SESSION["usuario"];
    $directorio = "usuarios/$usuarioVisto/";
    $rutaComentarios = $directorio . "publicacion$idPublicacion/comentarios.txt";

    $fecha = date("Y-m-d H:i:s");

    // Registrar el evento de comentario en un archivo de log
    $f2 = fopen("registros.log", "a+");
    if ($f2 != NULL) {
        if ($usuario === $usuarioVisto) {
            fwrite($f2, "Fecha: [$fecha] . El usuario $usuario ha hecho un comentario en su propio muro" . PHP_EOL);
        } else {
            fwrite($f2, "Fecha: [$fecha] . El usuario $usuario ha hecho un comentario en el muro de $usuarioVisto" . PHP_EOL);
        }
        fclose($f2);
    }

    // Añadir el comentario al archivo de comentarios
    $f = fopen($rutaComentarios, "a");
    if ($f) {
        fwrite($f, "$usuario: $comentario" . PHP_EOL);
        fclose($f);
        return true;
    }
    return false;
}

// Función para mostrar las publicaciones de un usuario
function mostrarPublicaciones($usuario)
{
    $directorio = "usuarios/$usuario/";
    $contador = 1;
    // Array para almacenar publicaciones
    $publicaciones = [];

    // Explora los directorios de publicaciones del usuario para cargar cada publicación existente
    // Las publicaciones se guardan en directorios numerados en orden, asi : (publicacion1, publicacion2, ...).
    // Utilizamos un contador para construir el nombre de cada directorio y verificamos su existencia con is_dir.
    // Si un directorio existe, asumimos que contiene una publicación válida.

    while (is_dir($directorio . "publicacion$contador")) {
        $archivoPublicacion = $directorio . "publicacion$contador/publicacion$contador.txt";
        $rutaComentarios = $directorio . "publicacion$contador/comentarios.txt";

        if (file_exists($archivoPublicacion)) {
            $contenidoArchivo = file($archivoPublicacion, FILE_IGNORE_NEW_LINES);
            $fecha = isset($contenidoArchivo[0]) ? $contenidoArchivo[0] : '';
            $contenido = isset($contenidoArchivo[1]) ? $contenidoArchivo[1] : '';

            // Agregar la publicación al array de publicaciones
            $publicaciones[] = [
                'fecha' => $fecha,
                'contenido' => $contenido,
                'id' => $contador,
                'rutaComentarios' => $rutaComentarios
            ];
        }
        $contador++;
    }

    return $publicaciones; // Retornar las publicaciones encontradas
}

// Función para obtener la lista de usuarios registrados
function obtenerUsuarios()
{
    // Obtener los nombres de usuarios como array
    return array_keys(parse_ini_file("usuarios/usuarios.ini"));
}

?>
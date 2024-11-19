<?php

function existe($usuario)
{
    // Partimos de la hipótesis de que el usuario no va a existir
    $ok = NULL;
    // Cargamos en un array asociativo el fichero de usuarios
    $usuarios = parse_ini_file("usuarios.ini");
    // Preguntamos si existe la clave $usuario dentro del array
    if (isset($usuarios[$usuario])) {
        // Si existe guardamos su contraseña para devolverla
        $ok = $usuarios[$usuario];
    }
    return $ok;

}
function acceder($usuario, $clave)
{
    $ok = false;
    $clave_usuario = existe($usuario);

    if ($clave_usuario != NULL && $clave_usuario == $clave) {
        // Si coinciden, devolveremos true como valor indicativo de acceso autorizado 
        $ok = true;
    }
    return $ok;
}
function grabar($usuario, $clave)
{
    // Pensamos que algo puede fallar
    $ok = false;
    // Abrimos el fichero en modo de añadir "a+" Ver los diferentes modos de apertura: 
    // https://www.php.net/manual/es/function.fopen.php
    // Abrimos el fichero y obtenemos un descriptor de fichero a través del cual realizar las operaciones de lectura, escritura, cierre, etc
    $f = fopen("usuarios.ini", "a+");
    // si se ha podido abrir ....
    if ($f != NULL) {
        // Grabamos la línea
        $ok = fwrite($f, "$usuario=$clave" . PHP_EOL); // ok tomará el valor false si no se ha podido grabar
        // Cerramos el fichero 
        fclose($f);
    }
    return $ok;
}

// Función 'registrar' que comprueba que el usuario no existe para después añadirlo 
// al fichero de usuarios y crear su directorio de trabajo
// Devuelve true si se ha podido registrar y false en caso contrario 
function registrar($usuario, $clave)
{
    // Pensamos que no se va a poder registrar
    $ok = false;
    // Preguntamos si existe, nos devuelve NULL si el usuario no existe
    if (existe($usuario) == NULL) { // se podría expresar if (!existe($usuario)) { .....
        $ok = grabar($usuario, $clave);
        // Si se ha podido grabar 
        if ($ok != false) {
            // Creamos la carpeta con el nombre de usuario
            $ok = mkdir($usuario, 0777, true);
            // La carpeta se crea en el mismo directorio en el que se está ejecutando el script
            // Si todo ha ido bien $ok tendrá el valor true
        }
    }
    return $ok;
}

function abrir($nombre_fichero)
{
    if (file_exists($nombre_fichero)) {
        // El @ suprime cualquier advertencia que pueda generar file_get_contents
        return @file_get_contents($nombre_fichero);
    } else {
        return false;
    }
}

function guardar($nombre_fichero, $contenido)
{
    // Intentar escribir el contenido en el archivo
    $ok = @file_put_contents($nombre_fichero, $contenido);
    return $ok !== false; // Devuelve true si se ha escrito correctamente, false si falla
}





?>
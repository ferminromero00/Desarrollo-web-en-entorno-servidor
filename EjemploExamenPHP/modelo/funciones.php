<?php

function registrar($usuario, $contraseña)
{
    $ok = false;

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
    return $ok;
}


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

function mostrarFormularios()
{
    $ruta = "vistas/examenes/.";
    $ficheros = scandir($ruta);

    $ficherosFiltrados = [];
    foreach ($ficheros as $fichero) {
        if ($fichero !== '.' && $fichero !== '..') {
            $ficherosFiltrados[] = $fichero;
        }
    }

    return $ficherosFiltrados;
}




?>
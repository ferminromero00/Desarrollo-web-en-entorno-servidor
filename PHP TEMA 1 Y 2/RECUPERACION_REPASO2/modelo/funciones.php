<?php

function registrarse($nombre, $contrasena)
{
    $ruta = 'notas/usuarios.ini';

    $f = fopen($ruta, "a+");
    fwrite($f, $nombre . "=" . $contrasena . PHP_EOL);
    fclose($f);

    if (!is_dir("notas/$nombre")) {
        mkdir("notas/$nombre");
    }

    return true;
}

function entrar($nombre, $contrasena)
{
    $ruta = 'notas/usuarios.ini';

    $usuarios = parse_ini_file($ruta);

    if (isset($usuarios[$nombre]) && $usuarios[$nombre] === $contrasena) {
        return true;
    } else {
        return false;
    }

}

function listarDirectorios($user)
{

    $ruta = 'notas/' . $user;
    $directorios = [];

    $ficheros = scandir($ruta);

    foreach ($ficheros as $f) {
        if ($f != "." && $f != "..") {
            array_push($directorios, $f);
        }
    }

    return $directorios;
}

function listarNotas($direct, $user)
{
    $ruta = 'notas/' . $user . '/' . $direct;
    $notas = [];

    $ficheros = scandir($ruta);

    foreach ($ficheros as $f) {
        if ($f != "." && $f != "..") {
            array_push($notas, $f);
        }
    }

    return $notas;
}


function creardirectorioNuevo($nombredirectorio)
{
    $direct = 'notas/' . $_SESSION["usuario"];
    $ruta = $direct . '/' . $nombredirectorio;

    if (is_dir($direct)) {
        if (!is_dir($ruta)) {
            mkdir($ruta);
        }
    }
}

function borrarDirectorio($nomBorrar)
{
    $ruta = 'notas/' . $_SESSION["usuario"] . '/' . $nomBorrar;
    rmdir($ruta);
}

function borrarNota($nomnota)
{
    $ruta = 'notas/' . $_SESSION["usuario"] . '/' . $_SESSION["direct"] . '/' . $nomnota;
    unlink($ruta);
}

function crearNota($nuevanota)
{
    $ruta = 'notas/' . $_SESSION["usuario"] . '/' . $_SESSION["direct"];
    touch($ruta . '/' . $nuevanota);
}




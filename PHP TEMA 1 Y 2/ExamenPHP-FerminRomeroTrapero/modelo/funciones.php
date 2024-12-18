<?php

function registrarse($nombre, $contrasena)
{
    $ruta = 'usuarios/usuarios.ini';
    $usuarios = parse_ini_file($ruta);

    if (isset($usuarios[$nombre])) {
        $_SESSION["alerta"] = "Ya existe un usuario con ese usuario";
    } else {
        $f = fopen($ruta, "a+");
        fwrite($f, $nombre . "=" . $contrasena . PHP_EOL);
        fclose($f);

        if (!is_dir("usuarios/$nombre")) {
            mkdir("usuarios/$nombre");
        }

        mkdir("usuarios/$nombre/enviados");
        mkdir("usuarios/$nombre/recibidos");

        $_SESSION["alerta"] = "Usuario creado con exito";
        return true;
    }
}

function entrar($nombre, $contrasena)
{
    $ruta = 'usuarios/usuarios.ini';

    $usuarios = parse_ini_file($ruta);

    if (isset($usuarios[$nombre]) && $usuarios[$nombre] === $contrasena) {
        return true;
    } else {
        return false;
    }

}

function verRecibidos($usuario)
{
    $ruta = 'usuarios/' . $usuario . '/recibidos';

    $enviados = [];

    $ficheros = scandir($ruta);

    foreach ($ficheros as $f) {
        if ($f != "." && $f != "..") {
            array_push($enviados, $f);
        }
    }
    return $enviados;
}

function verEnviados($usuario)
{
    $ruta = 'usuarios/' . $usuario . '/enviados';

    $enviados = [];

    $ficheros = scandir($ruta);

    foreach ($ficheros as $f) {
        if ($f != "." && $f != "..") {
            array_push($enviados, $f);
        }
    }
    return $enviados;
}

function vercontenido($nombrefichero, $fichero, $us)
{
    chmod("usuarios", "0755");
    chmod('usuarios/' . $us, "0755");
    chmod('usuarios/' . $us . '/' . $nombrefichero, "0755");
    $ruta = 'usuarios/' . $us . '/' . $nombrefichero . '/' . $fichero;
    $respuestas = file_get_contents($ruta);
    return $respuestas;


}

function buscarUsuarios()
{
    $ruta = 'usuarios';

    $users = [];

    $ficheros = scandir($ruta);

    foreach ($ficheros as $f) {
        if ($f != "." && $f != ".." && $f != "usuarios.ini") {
            array_push($users, $f);
        }
    }
    return $users;

}

function redactar($valorlista, $asunto, $contenido)
{

    $rutaPropietario = "usuarios/" . $_SESSION["usuario"] . '/enviados';
    $rutaEnviar = "usuarios/" . $valorlista . '/recibidos';
    $date = date("u");

    $asunto = "($date) $asunto";
    $asuntoSinFecha = $asunto;

    touch($rutaPropietario . '/' . $asunto);
    touch($rutaEnviar . '/' . $asunto);

    $rutacompletaProp = $rutaPropietario . '/' . $asunto;
    $rutacompletaEnviado = $rutaEnviar . '/' . $asunto;

    escribircontenido($rutacompletaProp, $rutacompletaEnviado, $valorlista, $asuntoSinFecha, $contenido);

}

function escribircontenido($ruta1, $ruta2, $nom, $asuntoSinFecha, $contenido)
{
    $f = fopen($ruta1, "a+");
    fwrite($f, "Para " . $nom . PHP_EOL);
    fwrite($f, $_SESSION["asuntoo"] . PHP_EOL);
    fwrite($f, $contenido . PHP_EOL);
    fclose($f);

    $f = fopen($ruta2, "a+");
    fwrite($f, "Para " . $nom . PHP_EOL);
    fwrite($f, $_SESSION["asuntoo"] . PHP_EOL);
    fwrite($f, $contenido . PHP_EOL);
    fclose($f);
}

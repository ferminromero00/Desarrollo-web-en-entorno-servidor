<?php

//FUNCION PARA COMPROBAR SI EXISTE EL USUARIO QUE DESPUES VA A ACCEDER 
function existe($usuario)
{
    //Partimos de que el usuario no va a existir
    $ok = NULL;

    //Cargamos un array asociativo al fichero de usuarios
    $usuarios = parse_ini_file("usuarios/usuarios.ini");

    if (isset($usuarios["$usuario"])) {
        $ok = $usuarios["$usuario"];
    }

    return $ok;
}


function acceder($usuario, $clave)
{
    $ok = false;

    //Llamo a la funcion existe para coger la contraseña del usuario si existe
    $clave_usuario = existe($usuario);

    if ($clave_usuario != NULL && $clave_usuario = $clave) {
        $ok = true;
    }

    return $ok;
}

//funcion para grabar usuarios en usuarios.ini

function grabar($usuario, $clave)
{
    $ok = false;

    $f = fopen("usuarios/usuarios.ini", "a+");
    if ($f != NULL) {

        $ok = fwrite($f, "$usuario=$clave" . PHP_EOL);
        fclose($f);
    }
    return $ok;
}

function registrar($usuario, $clave)
{
    $ok = false;

    if (existe($usuario) == NULL) {
        $ok = grabar($usuario, $clave);

        if ($ok != false) {
            $ok = mkdir("usuarios/$usuario", 0777, true);
        }
    }

    return $ok;
}



function leerUsuarios(){
    $usuarios = [];

    $ficheros = scandir("usuarios");

    foreach ($ficheros as $fichero) {
        if (!is_file("usuarios/$fichero") && $fichero != "." && $fichero != "..") {
            array_push($usuarios, $fichero);
        }
        
    }
    return $usuarios;
}


function leerPreguntas($miembro) {

    $preguntas = [];
        
    $ficheros = scandir("usuarios/$miembro");
    foreach ($ficheros as $fichero) {
        // echo $fichero;
        if (!is_dir($fichero)) {
            array_push($preguntas, $fichero);
        }
    }
    return $preguntas;
}


function guardarRespuesta($m, $p, $u, $r) {

    $ok = false;

    $f = fopen("usuarios/$m/$p","a+");
    if ($f) {
        fwrite($f,$u.":");
        fwrite($f,$r.PHP_EOL);
        fclose($f);
        $ok = true;
    }
    return $ok;
    
}

function leerRespuestas($pregunta) {

    $respuestas = [];
    $f = fopen($pregunta,"r");
    if ($f) {
        while (!feof($f)) {
            array_push($respuestas, fgets($f));
        }
        fclose($f);
    }

    return $respuestas;


}


function crearPregunta($m, $p) {

    $ok = false;
    $f = fopen("usuarios/$m/$p","w");
    if ($f) {
        fflush($f);
        fclose($f);
        $ok = true;
    }
    return $ok;
}
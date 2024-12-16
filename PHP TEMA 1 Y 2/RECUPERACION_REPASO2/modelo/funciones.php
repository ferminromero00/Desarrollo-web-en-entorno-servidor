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



















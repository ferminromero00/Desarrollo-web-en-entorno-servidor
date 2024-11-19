<?php

function mostrarFormularios()
{
    $ruta = "vistas/examenes/.";
    $ficheros = scandir($ruta);

    return $ficheros;

}

function agregarPreguntas($contenido)
{
    $ruta2 = "vistas/examenes/$_SESSION[nombreFichero]/$contenido";

    $f = fopen($ruta2, "w");
    if ($f) {
        fclose($f);
    }

    $ok = true;
    return $ok;

}

function respuestas()
{
    $fich = $_SESSION["nombreFichero"];
    $ruta3 = "vistas/examenes/$fich/";
    $ficheros = scandir($ruta3);

    return $ficheros;

}





?>
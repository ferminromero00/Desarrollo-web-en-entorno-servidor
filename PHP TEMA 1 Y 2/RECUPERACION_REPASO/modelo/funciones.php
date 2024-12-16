<?php

function leerCuestionario($ruta)
{
    $cuestionarios = [];
    $ficheros = scandir($ruta);

    foreach ($ficheros as $f) {
        if ($f != "." && $f != "..") {
            array_push($cuestionarios, $f);
        }
    }
    return $cuestionarios;
}

function leerPreguntas($cuestionarioNombre)
{
    $result = [];
    $ruta = "examenes/$cuestionarioNombre";

    $ficheros = scandir($ruta);

    foreach ($ficheros as $f) {
        if ($f != "." && $f != ".." && $f != "respuestas.txt") {
            array_push($result, $f);
        }
    }

    return $result;
}

function enviarPregunta($respuesta)
{
    $ruta = 'examenes/' . $_SESSION["nameCuestionario"] . '/' . $_SESSION["pregunta"];

    $f = fopen($ruta, "a");
    if ($f) {
        fwrite(
            $f,
            'Respuesta de ' . $_SESSION["persona"] . ': ' . $respuesta . PHP_EOL
        );
        fclose($f);
    }
}

function leerRespuestas($preguntanombre)
{   
    $ruta = 'examenes/' . $_SESSION["nameCuestionario"] . '/' . $_SESSION["pregunta"];
    $respuestas = file_get_contents($ruta);
    return $respuestas;

}





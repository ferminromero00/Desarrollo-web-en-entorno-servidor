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
        if ($f != "." && $f != "..") {
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
    return $_SESSION["msj"] = "Respuesta guardada con exito";
}

function leerRespuestas($preguntanombre)
{
    $ruta = 'examenes/' . $_SESSION["nameCuestionario"] . '/' . $preguntanombre;
    $respuestas = file_get_contents($ruta);
    return $respuestas;

}

function agregarPregunta($cuestio, $newPregunta)
{
    $ruta = 'examenes/' . $cuestio;
    $file = fopen($ruta . "/" . $newPregunta, "w");
    fclose($file);

    return $_SESSION["msj"] = "Pregunta añadida con exito";
}



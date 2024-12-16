<?php

$vista = "acceso.php";

if (isset($_REQUEST["accion"])) {
    $accion = strtolower(str_replace(" ", "", $_REQUEST["accion"]));

    switch ($accion) {
        case "acceder":
            $_SESSION["persona"] = $_REQUEST["name"];
            $cuestionarios = leerCuestionario('examenes');
            $vista = "vercuestionarios.php";
            break;
        case "responder":
            $_SESSION["nameCuestionario"] = $_REQUEST["cuestionario"];
            $seleccion = leerPreguntas($_REQUEST["cuestionario"]);
            $vista = "ResponderCuestionario.php";
            break;
        case "cerrar":
            session_unset();
            session_destroy();
            $vista = "acceso.php";
            break;
        case "contestar":
            $_SESSION["pregunta"] = $_REQUEST["nombrepregunta"];
            $vista = "contestarPregunta.php";
            break;
        case "enviarrespuesta":
            $enviar = enviarPregunta($_REQUEST["respuesta"]);
            //Defino esto otra vez en la redireccion para evitar errores
            $seleccion = leerPreguntas($_SESSION["nameCuestionario"]);
            $vista = "ResponderCuestionario.php";
            break;
        case "vertodaslasrespuestas":
            $_SESSION["nameCuestionario"] = $_REQUEST["cuestionario"];
            $seleccion = leerPreguntas($_REQUEST["cuestionario"]);
            $vista = "leerRespuestas.php";
            break;
        case "verrespuestas":
            $_SESSION["pregunta"] = $_REQUEST["nombrepregunta"];
            $ver = leerRespuestas($_SESSION["pregunta"]);
            $vista = "respuestas.php";
            break;
        case "agregarpregunta":
            $_SESSION["nameCuestionario"] = $_REQUEST["cuestionario"];
            $vista = "AgregarPreguntas.php";
            break;
        case "agregar":
            $agregar = agregarPregunta($_SESSION["nameCuestionario"], $_REQUEST["nuevapregunta"]);
            $cuestionarios = leerCuestionario('examenes');
            $vista = "vercuestionarios.php";
            break;
    }
}
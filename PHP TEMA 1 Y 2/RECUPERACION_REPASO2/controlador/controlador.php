<?php

$vista = "acceso.php";

if (isset($_REQUEST["accion"])) {
    $accion = strtolower(str_replace(" ", "", $_REQUEST["accion"]));

    switch ($accion) {
        case "registrarse":
            $nom = $_REQUEST["name"];
            $pass = $_REQUEST["pass"];

            $validacion = registrarse($nom, $pass);

            if ($validacion) {
                $_SESSION["alert"] = "Usuario registrado con exito";
            } else {
                $_SESSION["alert"] = "ERROR";
            }
            break;
        case "entrar":
            $nom = $_REQUEST["name"];
            $pass = $_REQUEST["pass"];

            $validacion = entrar($nom, $pass);

            if ($validacion) {
                $_SESSION["usuario"] = $nom;
                $lecturaDirectorios = listarDirectorios($_SESSION["usuario"]);
                $vista = "PaginaPrincipal.php";
            }


            break;

        case "cerrar":
            session_unset();
            session_destroy();
            break;

        case "ver":
            $_SESSION["direct"] = $_REQUEST["directorio"];
            $seleccion = listarNotas($_REQUEST["directorio"], $_SESSION["usuario"]);

            $vista = "vernotas.php";
            break;
        case "volver":
            $lecturaDirectorios = listarDirectorios($_SESSION["usuario"]);
            $vista = "PaginaPrincipal.php";
            break;

        case "creardirectorio":
            $directNuevo = $_REQUEST["newQuest"];
            $crear = creardirectorioNuevo($directNuevo);

            $lecturaDirectorios = listarDirectorios($_SESSION["usuario"]);
            $vista = "PaginaPrincipal.php";
            break;
        case "borrar":
            $_SESSION["direct"] = $_REQUEST["directorio"];
            $borrar = borrarDirectorio($_SESSION["direct"]);

            $lecturaDirectorios = listarDirectorios($_SESSION["usuario"]);
            $vista = "PaginaPrincipal.php";
            break;
        case "quitar":
            $_SESSION["nota"] = $_REQUEST["nota"];
            $borrar = borrarNota($_REQUEST["nota"]);

            $seleccion = listarNotas($_SESSION["direct"], $_SESSION["usuario"]);
            $vista = "vernotas.php";
            break;
        case "nuevanota":
            $newNota = $_REQUEST["newNota"];
            $borrar = crearNota($newNota);

            $seleccion = listarNotas($_SESSION["direct"], $_SESSION["usuario"]);
            $vista = "vernotas.php";
            break;
    }




}



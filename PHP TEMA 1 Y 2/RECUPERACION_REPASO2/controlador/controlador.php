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
    }


}
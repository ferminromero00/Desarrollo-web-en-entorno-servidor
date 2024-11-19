<?php

if (isset($_REQUEST["accion"])) {
    $accion = str_replace(" ", "", strtolower($_REQUEST["accion"]));

    if ($accion === "acceder") {
        $ok = acceder($_REQUEST["usuario"], $_REQUEST["clave"]);
        if ($ok) {
            $_SESSION["usuario"] = $_REQUEST["usuario"];
            $vista = "PaginaPrincipal.php";
        } else {
            $_SESSION["mensaje"] = "Usuario incorrecto";
            $vista = "identificacion.php";
        }
    } elseif ($accion === "registrarme") {
        $ok = registrar($_REQUEST["usuario"], $_REQUEST["clave"]);
        $_SESSION["mensaje"] = $ok ? "Usuario registrado" : "Error: el usuario no se ha podido registrar";
        $vista = "identificacion.php";
    } elseif ($accion === "cerrar_sesion") {
        session_unset();
        session_destroy();
        $vista = "identificacion.php";
    }
}
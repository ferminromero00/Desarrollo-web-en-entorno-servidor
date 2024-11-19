<?php
if (isset($_REQUEST["accion"])) {
    $accion = $_REQUEST["accion"];

    switch ($accion) {
        case "Acceder":
            $nom = $_REQUEST["nombre"];
            $pass = $_REQUEST["pass"];

            // Comprobar si el usuario y contraseña son correctos
            $comprobar = comprobacion($nom, $pass);

            if ($comprobar) {
                // Si la comprobación es exitosa, inicia sesión
                $_SESSION["usuario"] = $_REQUEST["nombre"];
                $usuario = $_SESSION["usuario"];
                $vista = "vistas" . DIRECTORY_SEPARATOR . "pagPrincipal.php";
            } else {
                $_SESSION["msj"] = "Usuario o contraseña incorrectos";
                $vista = "vistas" . DIRECTORY_SEPARATOR . "inicioSesion.php";
            }
            break;

        case "Registrar":
            $nom = $_REQUEST["nombre"];
            $pass = $_REQUEST["pass"];

            if ($nom === "" || $pass === "") {
                break;
            }

            $registro = registrar($nom, $pass);

            if ($registro) {
                $_SESSION["msj"] = "Registro realizado con éxito";
            } else {
                $_SESSION["msj"] = "Registro fallido";
            }

            $vista = "vistas" . DIRECTORY_SEPARATOR . "inicioSesion.php";
            break;

        case "Cerrar_Sesion":
            session_unset();
            session_destroy();
            $vista = "vistas" . DIRECTORY_SEPARATOR . "inicioSesion.php";
            break;

        case "Responder":




            break;
    }
}

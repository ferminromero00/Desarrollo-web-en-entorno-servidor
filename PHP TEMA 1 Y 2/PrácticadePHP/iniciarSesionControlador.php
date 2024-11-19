<?php
session_start();
require_once("funciones.php");

if (isset($_POST["accion"])) {
    $accion = $_POST["accion"];
    $usuario = $_POST["user"];
    $clave = $_POST["pass"];

    switch ($accion) {
        case "Acceder":
            $ok = acceder($usuario, $clave);

            if ($ok == true) {
                $_SESSION["usuario"] = $usuario;
                header("Location: blocdenotas.php");
                exit();
            } else {
                header("Location: index.php?mensaje=Error: el usuario no existe");
                exit();
            }

        case "Registrarte":
            $ok = registrar($usuario, $clave);
            if ($ok) {
                $mensaje = "Usuario registrado";
            } else {
                $mensaje = "Error: el usuario no se ha podido registrar";
            }
            header("Location: index.php?mensaje=$mensaje");
            break;
        case "Cerrar_sesion": // Elimino las variables de sesión
            session_unset();
            session_destroy();
            // Y nos redirigimos a la página de login
            header("Location: index.php?mensaje=Sesion cerrada.");
            break;
    }
}

<?php
if (isset($_REQUEST["accion"])) {
    $accion = str_replace(" ", "", strtolower($_REQUEST["accion"]));
    $fecha = date("Y-m-d H:i:s"); // Obtener la fecha actual
    switch ($accion) {
        case "acceder":
            $comprobar = comprobacion($_REQUEST["nombre"], $_REQUEST["contraseña"]);

            if ($comprobar) {
                $_SESSION["usuario"] = $_REQUEST["nombre"];
                $f2 = fopen("registros.log", "a+");
                if ($f2 != NULL) {
                    fwrite($f2, "Fecha: [$fecha] . Se ha iniciado sesion correctamente con el usuario $_REQUEST[nombre]" . PHP_EOL);
                    fclose($f2);
                }
                header("Location: index.php");
                exit();
            } else {
                $_SESSION["mensaje"] = "Usuario no existe o contraseña incorrecta";
                $f2 = fopen("registros.log", "a+");
                if ($f2 != NULL) {
                    fwrite($f2, "Fecha: [$fecha] . Se ha intentado iniciar sesion con el usuario $_REQUEST[nombre], inicio de sesion incorrecto " . PHP_EOL);
                    fclose($f2);
                }
                header("Location: index.php");
                exit();
            }

        case "registrarse":
            $registro = registrar($_REQUEST["nombre"], $_REQUEST["contraseña"]);

            if ($registro) {
                $_SESSION["mensaje"] = "Usuario registrado con éxito";
            } else {
                $_SESSION["mensaje"] = "No se ha podido registrar el usuario";
            }
            header("Location: index.php");
            exit();

        case "cerrar_sesion":
            $usuario = $_SESSION["usuario"];
            session_unset();
            session_destroy();
            $f2 = fopen("registros.log", "a+");
            if ($f2 != NULL) {
                fwrite($f2, "Fecha: [$fecha] . El usuario $usuario ha cerrado la sesion" . PHP_EOL);
                fclose($f2);
            }
            header("Location: index.php");
            exit();
    }
}
?>
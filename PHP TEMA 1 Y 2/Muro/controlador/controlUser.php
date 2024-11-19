<?php
// Si se ha pulsado el botón 'acción' recojo los campos 
// usuario y clave
$usuario = "";
$clave = "";
$ver = "";
if (isset($_REQUEST["accionUsuario"])) {
    // Convetimos a minúscula y eliminamos los espacios
    $accion = str_replace(" ", "", strtolower($_REQUEST["accionUsuario"]));

    switch ($accion) {
        case "acceder":
            $usuario = $_REQUEST["usuario"];
            $clave = $_REQUEST["clave"];
            // Preguntamos si existe el usuario con esa clave en el fichero de usuarios
            $ok = acceder($usuario, $clave);
            if ($ok == true) {
                // Creamos la variable de sesión 'usurio y guardamos el nombre de usuario y creamos 
                $_SESSION["usuario"] = $usuario;
                $usuarioVisto = $_SESSION["usuario"];
                // Redirigimos hacia el bloc de notas
                $vista = "home.php";
            } else {
                $mensaje = "Usuario incorrecto";
                $vista = "identificacion.php";
                //header("Location: index.php?mensaje=Usuario incorrecto");
            }
            break;
        case "registrarme":
            $usuario = $_REQUEST["usuario"];
            $clave = $_REQUEST["clave"];
            if($usuario=="" || $clave == ""){
                $mensaje = "No dejes los campos vacíos.";
                break;
            }
            $ok = registrar($usuario, $clave);
            if ($ok) {
                $mensaje = "Usuario registrado";
                //header("Location: index.php");
            } else {
                $mensaje = "Usuario incorrecto";
            }
            break;
        case "cerrarsesion":
            //? Elimino las variables de sesión
            session_unset();
            //? Destruyo la sesión
            session_destroy();
            $vista = "identificacion.php";
            header("Location: index.php");
            break;
    }
}

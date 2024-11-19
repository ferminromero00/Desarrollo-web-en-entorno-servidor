<?php 
session_start();
// Si se ha pulsado el botón 'acción' recojo los campos 
// usuario y clave
require_once("funciones.php");

if (isset($_REQUEST["accion"])) {
    // Convetimos a minúscula y eliminamos los espacios
    $accion = str_replace(" ","", strtolower($_REQUEST["accion"]));
    // Recogemos los campos
    $usuario = $_REQUEST["usuario"];
    $clave = $_REQUEST["clave"];
    switch ($accion) {
        case "acceder":
            // Preguntamos si existe el usuario con esa clave en el fichero de usuarios
            $ok = acceder($usuario, $clave);
            if ($ok == true) {
                // Creamos la variable de sesión 'usurio y guardamos el nombre de usuario y creamos 
                $_SESSION["usuario"] = $usuario;
                // Redirigimos hacia el bloc de notas
                header("Location: blocdenotas.php");
            }else{
                $mensaje = "Usuario incorrecto";                
                
            }   
            break;
        case "registrarme":
            $ok = registrar($usuario, $clave);
            if ($ok) {
                $mensaje = "Usuario registrado";
            }else{
                $mensaje = "Error: el usuario no se ha podido registrar";
            }
            break;
        

        case "cerrarsesión": // Elimino las variables de sesión
            session_unset();
            // Destruyo la sesión
            session_destroy();
            // Y nos redirigimos a la página de login
            // header("Location: index.php");
            break;
    }  
}      

?>
<?php

if (isset($_REQUEST["accionusuario"])) {
    // Limpiamos la acción recibida: convertimos a minúsculas y eliminamos espacios
    $accion = str_replace(" ", "", strtolower($_REQUEST["accionusuario"]));


    switch($accion){

        case "acceder": 
            $usuario=$_REQUEST["usuario"]; 
            $clave=$_REQUEST["clave"];
            
            
            $ok=acceder($usuario,$clave); 

            if($ok){
                $_SESSION["usuario"]=$usuario; 
                $vista="foro.php"; 
                $miembros=leerUsuarios(); 
            }else {
                $mensaje="Usuario Incorrecto"; 
                $vista="identificacion.php"; 
            }
            
            break; 

        case "registrarme": 
            $usuario=$_REQUEST["usuario"]; 

            $ok=registrar($usuario, $_REQUEST["clave"]); 

            if($ok){
                $mensaje="Usuario registrado"; 
            }else {
                $mensaje="ERROR: El usuario no se ha podido registrar"; 
            }

            $vista="identificacion.php"; 
            break; 

        case "cerrarsesion": 
            
            if (isset($_SESSION["usuario"])) {
                $usuario = $_SESSION["usuario"];
                
            }
            // Limpiamos y destruimos la sesión actual
            session_unset(); // Limpiamos todas las variables de sesión
            session_destroy(); // Destruimos la sesión
            $vista = "identificacion.php"; // Redirigimos a la vista de identificación
            break;
        }
}
?>
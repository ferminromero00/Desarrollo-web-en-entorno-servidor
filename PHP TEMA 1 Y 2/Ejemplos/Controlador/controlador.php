<?php
    require_once("./Modelo/DBUsuarios.php");

    try {
        $dbusuarios = new DBUsuarios();
    }catch(Exception $e) {
        die("Imposible conectar con la base de datos");
    }

    if (isset($_REQUEST["accion"])) {
        $accion = str_replace(" ","",strtolower($_REQUEST["accion"]));
        switch ($accion) {
            
            // Recoge las credenciales de un usuario y comprueba su existencia
            case "entrar":
                $username = $_REQUEST["login"];
                $password = $_REQUEST["password"];
                try {
                    // Recogemos el objeto usuario
                    $usuario = $dbusuarios->entrar($username, $password);
                    // Si existe
                    if ($usuario) {
                        // Lo guardamos en la sesión
                        $_SESSION["usuario"] = $usuario;
                        // Y le damos la bienvenida
                        $vista = "inicio.php";
                    }
                }catch(MiExcepcion $e) {
                    // En caso de error emitimos un mensaje y depuramos
                    $tipo = "alert-danger";
                    $aviso = "¡¡ No se ha podido identificar al usuario !!";
                    $vista = "error.php";
                }
                break;
            case "salir":
                // destruimos variable usuario
                unset($_SESSION["usuario"]);
                // destruimos la sesión
                session_destroy();
                // destruimos la cookie
                setcookie("PHPSESSID","",-1);
                break;
            case "recibidos":
                // cambiamos la vista a la pagina recibidos.php
                $vista = "recibidos.php";
                break;
            case "enviados":
                // cambiamos la vista a la pagina enviados.php
                $vista = "enviados.php";
                break;
            case "ver":
                // cambiamos la vista a la pagina ver.php
                $vista = "ver.php";
                break;
            case "redactar":
                // cambiamos la vista a la pagina redactar.php
                $vista = "redactar.php";
                break;
        }
    }
?>
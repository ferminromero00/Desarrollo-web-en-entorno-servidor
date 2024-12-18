<?php
session_start();
require('modelo/funciones.php');

$vista = "login.php";

if (isset($_REQUEST["accion"])) {
    $accion = strtolower(str_replace(" ", "", $_REQUEST["accion"]));
    switch ($accion) {
        case "registrarse":
            $nom = $_REQUEST["usuario"];
            $pass = $_REQUEST["clave"];

            $validacion = registrarse($nom, $pass);

            if ($validacion) {
                $_SESSION["alert"] = "Usuario registrado con exito";
            } else {
                $_SESSION["alert"] = "ERROR";
            }
            break;

        case "cerrarsesion":
            session_unset();
            session_destroy();
            break;
        case "entrar":
            $nom = $_REQUEST["usuario"];
            $pass = $_REQUEST["clave"];

            $validacion = entrar($nom, $pass);
            if ($validacion) {
                $_SESSION["usuario"] = $nom;
                $vista = "PaginaPrincipal.php";
            }
            $_SESSION["seleccion"] = "Recibidos:";
            $seleccion = verRecibidos($nom);
            $_SESSION["verResultado"] = "";
            break;

        case "recibidos":
            $seleccion = verRecibidos($_SESSION["usuario"]);
            $_SESSION["seleccion"] = $_REQUEST["accion"];
            $vista = "PaginaPrincipal.php";
            break;
        case "enviados":
            $seleccion = verEnviados($_SESSION["usuario"]);
            $_SESSION["seleccion"] = $_REQUEST["accion"];
            $vista = "PaginaPrincipal.php";
            break;
        case "ver":
            $select = strtolower(str_replace(" ", "", $_SESSION["seleccion"]));
            $select2 = $_REQUEST["seleccionTabla"];
            $preguntaSeleccionada = vercontenido($select, $select2, $_SESSION["usuario"]);
            $_SESSION["verResultado"] = $preguntaSeleccionada;
            $vista = "PaginaPrincipal.php";
            break;
        case "redactar":
            $seleccion = buscarUsuarios();
            $_SESSION["seleccion"] = $_REQUEST["accion"];
            $vista = "PaginaPrincipal.php";
            break;
        case "enviarmensaje":
            $valorlista = $_REQUEST["destinatario"];
            $asunto = $_REQUEST["asunto"];
            $contenido = $_REQUEST["contenido"];

            $_SESSION["asuntoo"] = $asunto;
            $enviar = redactar($valorlista, $asunto, $contenido);
            $_SESSION["seleccion"] = "Enviados:";
            $seleccion = verEnviados($_SESSION["usuario"]);
            $vista = "PaginaPrincipal.php";

            break;
    }
}

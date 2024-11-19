<?php 
require_once('MiExcepcion.php');
require_once('Usuario.php');
require_once('Mensaje.php');
require_once('Database.php');

class DBUsuarios extends Database {

    public function existe($login) {

        $usuario = NULL;
        $sql = "SELECT * FROM usuarios WHERE login = '$login'";
        try {
            $cursor = parent::$conexion->query($sql);
            $fila = $cursor->fetch_assoc();
            if ($fila) $usuario = new Usuario($fila);
        }catch (Exception $e) {
            return new MiExcepcion($e, $sql, "Error en la consulta de existe");
        }
        return $usuario;
    }

    public function entrar($login, $password) {
        try {
            $usuario = $this->existe($login);
            if ($usuario && $usuario->getPassword() == $password) {
                // guardamos los mensajes del usuario en una variable mensajes
                $mensajes = $this->getMensajes($login);

                // al usuario le pasamos los mensajes obtenidos
                $usuario->setMensajes($mensajes);

            }else{
                return $usuario = NULL;
            }
        }catch (MiExcepcion $e) {
            throw $e;
        }
        return $usuario;
    }

    // funcion que recibe un nombre de usuario Ej: ana
    public function getMensajes($usuario) {
        // variable mensajes que inicia como array vacío
        $mensajes = array();

        // recogemos de la base de datos todos los mensajes que haya enviado y recibido el usuario
        $sql = "SELECT * FROM `mensajes` WHERE remitente = '$usuario' OR destinatario = '$usuario'";
            try {
            $cursor = parent::$conexion->query($sql);
            // convertimos el resultado en un array asociativo y lo guardamos en la variable fila
            $fila = $cursor->fetch_assoc();

            // recorremos las filas que contenga la salida de la sentencia sql
            while ($fila) {
                // por cada fila creamos un nuevo Objeto Mensaje
                $mensaje = new Mensaje($fila);
                // introducimos este nuevo Objeto Mensaje en el array de mensajes
                array_push($mensajes, $mensaje);
                $fila = $cursor->fetch_assoc();
            }
            $cursor->free();
        }catch (Exception $e) {
            throw new MiExcepcion($e, $sql, "no se han podido leer las actividades");
        }
        // retornamos los mensajes del usuario
        return $mensajes;
    }
}
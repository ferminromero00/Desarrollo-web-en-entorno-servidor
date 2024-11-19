<?php

class Usuario {

    private $login;
    private $password;
    private $nombre;
    private $mensajes;

    public function __construct($datos) {

        if (isset($datos)) {
            $this->login = $datos["login"];
            $this->password = $datos["password"];
            $this->nombre = $datos["nombre"];
            $this->mensajes = array();
        }
    }

    public function getLogin() {
        return $this->login;
    }

    public function getPassword() {
        return $this->login;
    }

    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Cambia la lista de mensajes por otra o 
     * por una vacía como array()
     */
    public function setMensajes($mensajes) {
        $this->mensajes = $mensajes;
    }

    /**
     * Añade un objeto mensaje a la lista de mensajes
     */

    public function addMensaje($mensaje) {
        array_push($this->mensajes, $mensaje);
    }

    /**
     * Devuelve un array con los mensajes recibidos
     */
    public function getRecibidos() {
        $mensajes = array();
        foreach ($this->mensajes as $m) {            
            if ($m->getDestinatario() == $this->login) {
                array_push($mensajes, $m);
            }
        }
        return $mensajes;
    }

    /**
     * Devuelve un array con los mensajes enviados
     */
    public function getEnviados() {
        $mensajes = array();
        foreach ($this->mensajes as $m) {            
            if ($m->getRemitente() == $this->login) {
                array_push($mensajes, $m);
            }
        }
        return $mensajes;
    }

    /**
     * Devuelve el mensaje cuyo id coincide con el id
     * que se le pasa como parámetro
     */
    public function getMensaje($id) {
       
        foreach ($this->mensajes as $m) {            
            if ($m->getId() == $id) {
                return $m;
            }
        }
        return NULL;
    }

}
<?php

class Mensaje {

    private $id;
    private $remitente;
    private $destinatario;
    private $asunto;
    private $cuerpo;

    public function __construct($datos) {
        if (isset($datos)) {
            $this->id = $datos["id"];
            $this->remitente = $datos["remitente"];
            $this->destinatario = $datos["destinatario"];
            $this->asunto = $datos["asunto"];
            $this->cuerpo = $datos["cuerpo"];
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getRemitente() {
        return $this->remitente;
    }

    public function getDestinatario() {
        return $this->destinatario;
    }

    public function getAsunto() {
        return $this->asunto;
    }

    public function getCuerpo() {
        return $this->cuerpo;
    }
}
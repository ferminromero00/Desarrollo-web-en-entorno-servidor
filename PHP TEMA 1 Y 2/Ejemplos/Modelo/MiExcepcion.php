<?php

class MiExcepcion extends Exception {
       
    private $mensaje;
    private $sql;

    public function __construct($message, $sql, $mensaje) {
        parent::__construct($message);        
        $this->sql = $sql;
        $this->mensaje = $mensaje;
        
    }
    
    public function getMensaje() {
        return $this->mensaje;
    }
    
    public function getSQL() {
        return $this->sql;
    }
}

?>
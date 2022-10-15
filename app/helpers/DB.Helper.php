<?php

class DBHelper {
    
    public function __construct() {

        // variables para conectarnos
        $this->host = 'localhost';
        $this->database = 'turno_facil';
        $this->user = 'root';
        $this->password = '';

    }

    /**
     * Conexion con la base de datos
     */
    public function connect() {

        $db = new PDO("mysql:host={$this->host};"."dbname={$this->database};charset=utf8", $this->user, $this->password);
        return $db;
    }  
    
}
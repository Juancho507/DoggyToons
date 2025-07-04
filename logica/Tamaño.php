<?php
require_once ("persistencia/TamañoDAO.php");
require_once ("persistencia/Conexion.php");

class Tamaño{
    private $id;
    private $tipo;
    
    
    public function getId(){
        return $this -> id;
    }
    
    public function getTipo(){
        return $this -> tipo;
    }
    public function __construct($id = 0, $tipo = ""){
        $this -> id = $id;
        $this -> tipo = $tipo;
    }
}

?>
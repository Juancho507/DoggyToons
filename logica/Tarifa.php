<?php
require_once ("persistencia/TarifaDAO.php");
require_once ("persistencia/Conexion.php");

class Tarifa {
    private $id;
    private $precioHora;
    private $paseadorIdPaseador;
    private $tamañoIdTamaño; 
    private $nombreTamaño; 
    
    public function __construct($id = "", $precioHora = "", $paseadorIdPaseador = "", $tamañoIdTamaño = "", $nombreTamaño = "") {
        $this->id = $id;
        $this->precioHora = $precioHora;
        $this->paseadorIdPaseador = $paseadorIdPaseador;
        $this->tamañoIdTamaño = $tamañoIdTamaño;
        $this->nombreTamaño = $nombreTamaño;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getPrecioHora() {
        return $this->precioHora;
    }
    
    public function getPaseadorIdPaseador() {
        return $this->paseadorIdPaseador;
    }
    
    public function getTamañoIdTamaño() {
        return $this->tamañoIdTamaño;
    }
    public function getNombreTamaño() { 
        return $this->nombreTamaño;
    }
}
?>
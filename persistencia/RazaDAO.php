<?php
class RazaDAO {
    private $id;
    private $nombre;
    private $tamaño;
    
    
    public function __construct($id = 0, $nombre = "", $tamaño = ""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> tamaño = $tamaño;
    }
    
    public function consultarTodasLasRazas() {
      
        return "SELECT idRaza, nombre FROM Raza";
    }
}
?>
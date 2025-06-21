<?php
require_once("persistencia/Conexion.php");
require_once("persistencia/RazaDAO.php");

class Raza{
    private $id;
    private $nombre;
    private $tamaño;
    
    public function getId(){
        return $this -> id;
    }
    
    public function getNombre(){
        return $this -> nombre;
    }
    public function getTamaño(){
        return $this -> tamaño;
    }
    public function __construct($id = 0, $nombre = "", $tamaño = ""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> tamaño = $tamaño;
    }
    public function consultarTodos() {
        $razaDAO = new RazaDAO();
        $sentencia = $razaDAO->consultarTodasLasRazas();
        
        $conexion = new Conexion();
        $conexion->abrir();
        $conexion->ejecutar($sentencia);
        
        $listaRazas = [];
        if ($conexion->filas() > 0) {
            while ($registro = $conexion->registro()) {
                $idRaza = $registro[0];
                $nombreRaza = $registro[1];
                $listaRazas[] = new Raza($idRaza, $nombreRaza); 
            }
        }
        $conexion->cerrar();
        return $listaRazas;
    }
}
?>

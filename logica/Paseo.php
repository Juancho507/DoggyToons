<?php
require_once("persistencia/Conexion.php");
require_once("persistencia/PaseoDAO.php");

class Paseo {
    private $id;
    private $fechaInicio;
    private $fechaFin;
    private $nombrePaseador;
    private $estadoPaseo;    
    
    public function getId(){
        return $this -> id;
    }
    public function getFechaInicio(){
        return $this -> fechaInicio;
    }
    public function getFechaFin(){
        return $this -> fechaFin;
    }
    public function getNombrePaseador(){
        return $this -> nombrePaseador;
    }
    public function getEstadoPaseo(){
        return $this -> estadoPaseo;
    }
    
    public function __construct($id = 0, $fechaInicio = "", $fechaFin = "", $nombrePaseador = "", $estadoPaseo = ""){
        $this -> id = $id;
        $this -> fechaInicio = $fechaInicio;
        $this -> fechaFin = $fechaFin;
        $this -> nombrePaseador = $nombrePaseador;
        $this -> estadoPaseo = $estadoPaseo;
    }
    public function consultarHistorial($rol, $idUsuarioSesion) {
        $listaPaseos = [];
        $paseoDAO = new PaseoDAO();
        $sentencia = "";
        
        $idUsuarioSanitizado = (int)$idUsuarioSesion;
        
        switch (strtolower($rol)) {
            case "dueño":
                $sentencia = $paseoDAO->consultarPaseosPorDueño($idUsuarioSanitizado);
                break;
            case "paseador":
                $sentencia = $paseoDAO->consultarPaseosPorPaseador($idUsuarioSanitizado);
                break;
            case "administrador": 
                $sentencia = $paseoDAO->consultarTodosLosPaseos();
                break;
            default:
                return [];
        }
        
        if (empty($sentencia)) {
            return []; 
        }
        
        $conexion = new Conexion();
        $conexion->abrir();
        $conexion->ejecutar($sentencia);
        
        if ($conexion->filas() > 0) {
            while ($registro = $conexion->registro()) {            
                $idPaseo = $registro[0];
                $fechaInicio = $registro[1];
                $fechaFin = $registro[2];
                $nombrePaseador = $registro[3];
                $estadoPaseo = $registro[4];
                
                $listaPaseos[] = new Paseo($idPaseo, $fechaInicio, $fechaFin, $nombrePaseador, $estadoPaseo);
            }
        }
        $conexion->cerrar();
        return $listaPaseos;
    }
}
?>
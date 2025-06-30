<?php
require_once("persistencia/Conexion.php");
require_once("persistencia/PaseoDAO.php");

class Paseo {
    private $id;
    private $fechaInicio;
    private $fechaFin;
    private $paseador;
    private $estadoPaseo;
    private $nombrePerro;
    
    
    public function getId(){
        return $this -> id;
    }
    public function getFechaInicio(){
        return $this -> fechaInicio;
    }
    public function getFechaFin(){
        return $this -> fechaFin;
    }
    public function getPaseador(){
        return $this -> paseador;
    }
    public function getEstadoPaseo(){
        return $this -> estadoPaseo;
    }
    public function getNombrePerro(){
        return $this->nombrePerro;
    }
    public function __construct($id = 0, $fechaInicio = "", $fechaFin = "",$paseador = "", $estadoPaseo = "", $nombrePerro="") {
        $this->id = $id;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->paseador = $paseador;
        $this->estadoPaseo = $estadoPaseo;
        $this->nombrePerro = $nombrePerro;
        
    }
    public function insertar($idPerro) {
        $conexion = new Conexion();
        $conexion->abrir();
        $fechaInicioDT = new DateTime($this->fechaInicio);
        $fechaFinDT = clone $fechaInicioDT;
        $fechaFinDT->modify('+1 hour');
        $this->fechaFin = $fechaFinDT->format('Y-m-d H:i:s');
        
        $paseoDAO = new PaseoDAO(0, $this->fechaInicio, $this->fechaFin, $this->paseador, $this->estadoPaseo);
        $conexion->ejecutar($paseoDAO->insertarPaseo());
        
        if ($conexion->getResultado()) {
            $idInsertado = $conexion->obtenerId(); 
            $conexion->ejecutar($paseoDAO->insertarPaseoPerro($idInsertado, $idPerro));
            $conexion->cerrar();
            return true;
        }
        
        $conexion->cerrar();
        return false;
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
                $paseador = $registro[3];
                $estadoPaseo = $registro[4];
                $nombrePerro = $registro [5];
                $listaPaseos[] = new Paseo($idPaseo, $fechaInicio, $fechaFin, $paseador, $estadoPaseo, $nombrePerro);
            }
        }
        $conexion->cerrar();
        return $listaPaseos;
    }


    
    public function asignarPerroAPaseo($Paseo, $idPerro) {
        $conexion = new Conexion();
        $conexion->abrir();
        $paseoDAO = new PaseoDAO();
        $conexion->ejecutar($paseoDAO->insertarPaseoPerro($Paseo, $idPerro));
        $conexion->cerrar();
    }
}

?>
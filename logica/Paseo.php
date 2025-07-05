<?php
require_once(__DIR__ . "/../persistencia/Conexion.php");
require_once(__DIR__ . "/../persistencia/PaseoDAO.php");


class Paseo {
    private $id;
    private $fechaInicio;
    private $fechaFin;
    private $paseador;
    private $estadoPaseo;
    private $nombrePerro;
    private $idEstadoPaseo;
    private $idPerro;
    private $precio;
    
    
    
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
  
    public function getIdPerro() {
        return $this->idPerro;
    }
    public function getPrecio() {
        return $this->precio;
    }
    public function setPrecio($precio) {
        $this->precio = $precio;
    }
    
    public function setIdPerro($idPerro) {
        $this->idPerro = $idPerro;
    }

    public function setFechaInicio($fecha) {
        $this->fechaInicio = $fecha;
    }
    
    public function setFechaFin($hora) {
        $this->fechaFin = $hora;
    }
    
    public function setNombrePerro($nombres) {
        $this->nombrePerro = $nombres;
    }
    public function setEstadoPaseo($estado) {
        $this->estadoPaseo = $estado;
    }
    
    public function __construct($id = 0, $fechaInicio = "", $fechaFin = "", $paseador = "", $estadoPaseo = "", $nombrePerro = "", $idPerro = 0) {
        $this->id = $id;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->paseador = $paseador;
        $this->estadoPaseo = $estadoPaseo;
        $this->nombrePerro = $nombrePerro;
        $this->idPerro = $idPerro;
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
                $nombrePerro = isset($registro[5]) ? $registro[5] : "";               
                $idPerro = isset($registro[6]) ? $registro[6] : 0;
                $p = new Paseo($idPaseo, $fechaInicio, $fechaFin, $paseador, $estadoPaseo, $nombrePerro);
                $p->setIdPerro($idPerro);
                $listaPaseos[] = $p;
                
               
                
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

    public function consultarRealizadosPorPaseador($idPaseador) {
        $conexion = new Conexion();
        $paseoDAO = new PaseoDAO();
        $conexion->abrir();
        $conexion->ejecutar($paseoDAO->consultarRealizadosPorPaseador($idPaseador));
        
        $resultados = [];
        while ($registro = $conexion->registro()) {
            $resultados[] = [
                "fechaInicio" => $registro[1],
                "fechaFin" => $registro[2],
                "perros" => $registro[3]
            ];
        }
        
        $conexion->cerrar();
        return $resultados;
    }
    public function actualizarEstado($nuevoEstado) {
        $conexion = new Conexion();
        $conexion->abrir();
        $paseoDAO = new PaseoDAO($this->id);
        $conexion->ejecutar($paseoDAO->actualizarEstado($nuevoEstado));
        $exito = $conexion->afectadas() > 0;
        $conexion->cerrar();
        return $exito;
    }
    public function consultarPendientesPorPaseador($idPaseador) {
        $conexion = new Conexion();
        $paseoDAO = new PaseoDAO();
        $conexion->abrir();
        $conexion->ejecutar($paseoDAO->consultarPendientesPorPaseador($idPaseador));
        
        $paseos = [];
        while ($registro = $conexion->registro()) {
            $paseo = new Paseo($registro[0]);
            $paseo->setFechaInicio($registro[1]);
            $paseo->setFechaFin($registro[2]);
            $paseo->setNombrePerro($registro[3]);
            $paseo->setEstadoPaseo($registro[4]);
            $paseos[] = $paseo;
        }
        
        $conexion->cerrar();
        return $paseos;
    }
    
    public function consultarPaseosCompletadosPorPerro($idPerro) {
        $paseos = [];
        
        $paseoDAO = new PaseoDAO();
        $sentencia = $paseoDAO->consultarPaseosCompletadosPorPerro($idPerro);
        
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
                $nombrePerro = $registro[5];
                $precio = $registro[6];
                
                $paseo = new Paseo(
                    $idPaseo,
                    $fechaInicio,
                    $fechaFin,
                    $paseador,
                    $estadoPaseo,
                    $nombrePerro,
                    $idPerro
                    );
                $paseo->setPrecio($precio);
                $paseos[] = $paseo; 
            }
        }
        
        $conexion->cerrar();
        return $paseos;
    }
    
    
    
}

?>
<?php
require_once ("logica/Persona.php");
require_once ("persistencia/PaseadorDAO.php");
require_once ("persistencia/Conexion.php");

class Paseador extends Persona{
    private $contacto;
    private $foto;
    private $informacion;
    private $tarifas = [];
    private $activo;
    
    public function getContacto(){
        return $this -> contacto;
    }
    
    public function getFoto(){
        return $this -> foto;
    }
    public function getInformacion() {
        return $this->informacion;
    }
    public function getTarifas() {
        return $this->tarifas;
    }
    public function getActivo() {
        return $this->activo;
    }
    public function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $contacto = "", $foto = "", $informacion = "", $activo = "") {
        parent::__construct($id, $nombre, $apellido, $correo, $clave, $contacto, $foto);
        $this->contacto = $contacto;
        $this->foto = $foto;
        $this->informacion = $informacion;
        $this->activo = $activo;
    }
    public function cerrar_sesion() {
        session_destroy();
    }
    public function autenticarse() {
        $conexion = new Conexion();
        $paseadorDAO = new PaseadorDAO("","","", $this -> correo, $this -> clave);
        $conexion -> abrir();
        $conexion -> ejecutar($paseadorDAO -> autenticarse());
        if($conexion -> filas() == 1){            
            $this -> id = $conexion -> registro()[0];
            $conexion->cerrar();
            return true;
        }else{
            $conexion->cerrar();
            return false;
        }

    }
    public function registrar() {
        $conexion = new Conexion();
        $conexion->abrir();
        $claveMd5 = md5($this->clave);
        $paseadorDAO = new PaseadorDAO(
            "", $this->nombre, $this->apellido, $this->correo, $claveMd5,
            $this->contacto, $this->foto, $this->informacion, 1
        );
        $conexion->ejecutar($paseadorDAO->registrar());
        $conexion->cerrar();
        return $conexion->getResultado();
    }
    public function actualizar() {
        $conexion = new Conexion();
        $conexion->abrir();
        $paseadorDAO = new PaseadorDAO(
            $this->id,
            $this->nombre,
            $this->apellido,
            $this->correo,
            $this->clave,
            $this->contacto,
            $this->foto,
            $this->informacion
            );$conexion->ejecutar($paseadorDAO->actualizar());
        $conexion->cerrar();
    }
    public function consultar(){
        $conexion = new Conexion();
        $paseadorDAO = new PaseadorDAO($this->id);
        $conexion->abrir();
        $conexion->ejecutar($paseadorDAO->consultar());
        
        if ($conexion->filas() > 0) {
            $datos = $conexion->registro();
            if ($datos !== null) {
                $this->nombre = $datos[0];
                $this->apellido = $datos[1];
                $this->correo = $datos[2];
                $this->clave = $datos[3]; 
                $this->contacto = $datos[4];
                $this->foto = $datos[5];
                $this->informacion = $datos[6];
                $this->activo = $datos[7]; 
                $this->consultarTarifas();
            }
        } else {
            $this->nombre = "";
            $this->apellido = "";
            $this->correo = "";
            $this->clave = "";
            $this->contacto = "";
            $this->foto = "";
            $this->informacion = "";
            $this->activo = "";
            $this->tarifas = [];
        }
        
        $conexion->cerrar();
    }
    public function consultarTodos() {
        $conexion = new Conexion();
        $conexion->abrir();
        $paseadorDAO = new PaseadorDAO();
        $conexion->ejecutar($paseadorDAO->consultarTodos());
        
        $paseadores = [];
        while ($registro = $conexion->registro()) {
        
            $tempPaseador = new Paseador( 
                $registro[0],
                $registro[1],
                $registro[2],
                $registro[3],
                "",
                $registro[4],
                $registro[5],
                $registro[6],
                $registro[7]
                );
            $tempPaseador->consultarTarifas();
            $paseadores[] = $tempPaseador; 
        }
        
        $conexion->cerrar();
        return $paseadores;
    }
    public function consultarTarifas() {
        
        $conexion = new Conexion();
        $tarifaDAO = new TarifaDAO();
        $conexion->abrir();
        $conexion->ejecutar($tarifaDAO->consultarPorPaseador($this->id));
        
        $this->tarifas = []; 
        while ($registroTarifa = $conexion->registro()) {
            if ($registroTarifa !== null) {
                $this->tarifas[] = new Tarifa(
                    $registroTarifa[0], 
                    $registroTarifa[1], 
                    $registroTarifa[2], 
                    $registroTarifa[3], 
                    $registroTarifa[4], 
                    $registroTarifa[5],
                    $registroTarifa[6]
                    );
            }
        }
        $conexion->cerrar();
    }
    public function correoExiste() {
    $conexion = new Conexion();
    $paseadorDAO = new PaseadorDAO("", "", "", $this->correo);
    $conexion->abrir();
    $conexion->ejecutar($paseadorDAO->correoExiste());
    $existe = $conexion->filas() > 0;
    $conexion->cerrar();
    return $existe;
}

    
}
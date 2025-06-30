<?php
require_once ("logica/Persona.php");
require_once ("persistencia/PaseadorDAO.php");
require_once ("persistencia/Conexion.php");

class Paseador extends Persona{
    private $contacto;
    private $foto;
    
    public function getContacto(){
        return $this -> contacto;
    }
    
    public function getFoto(){
        return $this -> foto;
    }
    public function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $contacto = "", $foto = "") {
        parent::__construct($id, $nombre, $apellido, $correo, $clave, $contacto, $foto);
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
                $this->contacto = $datos[3];
            }
        } else {
            $this->nombre = "";
            $this->apellido = "";
            $this->correo = "";
            $this->contacto = "";
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
            $paseadores[] = new Paseador($registro[0], $registro[1], $registro[2]);
        }
        
        $conexion->cerrar();
        return $paseadores;
    }
    
    
}
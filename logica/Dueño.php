<?php
require_once "logica/Persona.php";
require_once "persistencia/DueñoDAO.php";
require_once "persistencia/Conexion.php";

class Dueño extends Persona{
    public function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $contacto = "", $foto = "") {
        parent::__construct($id, $nombre, $apellido, $correo, $clave, $contacto, $foto);
    }
    public function cerrar_sesion() {
        session_destroy();
    }
    public function autenticarse() {
        $conexion = new Conexion();
        $dueñoDAO = new DueñoDAO("","","", $this -> correo, $this -> clave);
        $conexion -> abrir();
        $conexion -> ejecutar($dueñoDAO -> autenticarse());
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
        $dueñoDAO = new DueñoDAO($this -> id);
        $conexion -> abrir();
        $conexion -> ejecutar($dueñoDAO -> consultar());
        $datos = $conexion -> registro();
        $this -> nombre = $datos[0];
        $this -> apellido = $datos[1];
        $this -> correo = $datos[2];
        $conexion->cerrar();
    }
}
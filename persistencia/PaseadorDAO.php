<?php
class PaseadorDAO{
    private $id;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $contacto;
    private $foto;

    public function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $codigoRecuperacion = "", $fechaExpiracion = "", $foto = "", $contacto =""){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->clave = $clave;
        $this->foto = $foto;
    }

   public function autenticarse(){
    return "SELECT idPaseador
            FROM paseador 
            WHERE Correo = '" . $this->correo . "' 
              AND Clave = '" . md5($this->clave) . "'";
}

public function consultar(){
    return "SELECT Nombre, Apellido, Correo, Contacto
            FROM paseador
            WHERE idPaseador = '" . $this->id . "'";
}
public function consultarTodos() {
    return "SELECT idPaseador, Nombre, Apellido FROM Paseador";
}


} 
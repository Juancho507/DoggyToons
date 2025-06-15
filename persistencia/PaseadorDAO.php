<?php
class PaseadorDAO{
    private String $id;
    private String $nombre;
    private String $apellido;
    private String $correo;
    private String $clave;
    private $contacto;
    private $foto;

    public function __construct(String $id = "", String $nombre = "", String $apellido = "", String $correo = "", String $clave = "", String $codigoRecuperacion = "", String $fechaExpiracion = "", $foto = "", $contacto =""){
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
    return "SELECT Nombre, Apellido, Correo
            FROM paseador
            WHERE idPaseador = '" . $this->id . "'";
}
} 
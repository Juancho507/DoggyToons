<?php
class DueñoDAO{
    private String $id;
    private String $nombre;
    private String $apellido;
    private String $correo;
    private String $clave;
    private $contacto;
    private $foto;

    public function __construct(string $id = "", string $nombre = "", string $apellido = "", string $correo = "", string $clave = "", string $codigoRecuperacion = "", string $fechaExpiracion = "", string $contacto = "", string $foto = "") {
    $this->id = $id;
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->correo = $correo;
    $this->clave = $clave;
    $this->codigoRecuperacion = $codigoRecuperacion;
    $this->fechaExpiracion = $fechaExpiracion;
    $this->contacto = $contacto;
    $this->foto = $foto;
}


    public function autenticarse() {
        return "SELECT idDueño
                FROM Dueño
                WHERE correo = '" . $this -> correo . "' AND clave = '" . md5($this -> clave) . "'";
    }

    public function registrar() {
    return "INSERT INTO dueño (Nombre, Apellido, Correo, Clave, Contacto, Foto)
            VALUES (
                '{$this->nombre}',
                '{$this->apellido}',
                '{$this->correo}',
                '" . md5($this->clave) . "',
                '{$this->contacto}',
                '{$this->foto}'
            )";
}

public function correoExiste() {
    return "SELECT idDueño FROM dueño WHERE Correo = '{$this->correo}'";
}

    public function consultar() {
        return "SELECT nombre, apellido, correo, contacto
                FROM Dueño
                WHERE idDueño = " . $this->id;
    }
} 
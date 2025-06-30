<?php
class PaseoDAO {
    private $id;
    private $fechaInicio;
    private $fechaFin;
    private $idPaseador; 
    private $idEstadoPaseo; 
    
    public function __construct($id = 0, $fechaInicio = "", $fechaFin = "", $idPaseador = "", $idEstadoPaseo = ""){
        $this -> id = $id;
        $this -> fechaInicio = $fechaInicio;
        $this -> fechaFin = $fechaFin;
        $this -> idPaseador = $idPaseador;
        $this -> idEstadoPaseo = $idEstadoPaseo;
    }
    
    public function insertarPaseo() {
        return "INSERT INTO Paseo (FechaInicio, FechaFin, Paseador_idPaseador, EstadoPaseo_idEstadoPaseo)
                VALUES ('" . $this->fechaInicio . "', '" . $this->fechaFin . "', " . $this->idPaseador . ", " . $this->idEstadoPaseo . ")";
    }

    public function insertarPaseoPerro($idPaseo, $idPerro) {
        return "INSERT INTO PaseoPerro (Paseo_idPaseo, Perro_idPerro)
                VALUES (" . $idPaseo . ", " . $idPerro . ")";
    }
    public function consultarPaseosPorDueño($idDueño) {
        return "SELECT
                p.idPaseo,
                p.FechaInicio,
                p.FechaFin,
                CONCAT(pas.Nombre, ' ', pas.Apellido) AS paseador,
                ep.Valor AS EstadoPaseoValor,
                per.Nombre AS NombrePerro
            FROM Paseo p
            INNER JOIN Paseador pas ON p.Paseador_idPaseador = pas.idPaseador
            INNER JOIN EstadoPaseo ep ON p.EstadoPaseo_idEstadoPaseo = ep.idEstadoPaseo
            INNER JOIN PaseoPerro pp ON p.idPaseo = pp.Paseo_idPaseo
            INNER JOIN Perro per ON pp.Perro_idPerro = per.idPerro
            WHERE per.Dueño_idDueño = " . $idDueño . "
            ORDER BY p.FechaInicio DESC";
    }
    
 
    public function consultarPaseosPorPaseador($idPaseador) {
        return "SELECT
                    p.idPaseo,
                    p.FechaInicio,
                    p.FechaFin,
                    CONCAT(pas.Nombre, ' ', pas.Apellido) AS paseador,
                    ep.Valor AS EstadoPaseoValor
                FROM Paseo p
                INNER JOIN Paseador pas ON p.Paseador_idPaseador = pas.idPaseador
                INNER JOIN EstadoPaseo ep ON p.EstadoPaseo_idEstadoPaseo = ep.idEstadoPaseo
                WHERE p.Paseador_idPaseador = " . $idPaseador . "
                ORDER BY p.FechaInicio DESC";
    }
    public function consultarTodosLosPaseos() {
        return "SELECT
                    p.idPaseo,
                    p.FechaInicio,
                    p.FechaFin,
                    CONCAT(pas.Nombre, ' ', pas.Apellido) AS paseador,
                    ep.Valor AS EstadoPaseoValor
                FROM Paseo p
                INNER JOIN Paseador pas ON p.Paseador_idPaseador = pas.idPaseador
                INNER JOIN EstadoPaseo ep ON p.EstadoPaseo_idEstadoPaseo = ep.idEstadoPaseo
                ORDER BY p.FechaInicio DESC";
    }
}
?>
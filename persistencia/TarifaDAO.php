<?php

class TarifaDAO {
    private $id;
    private $precioHora;
    private $paseadorIdPaseador;
    private $tamanoIdTamano;
    
    public function __construct($id = "", $precioHora = "", $paseadorIdPaseador = "", $tamanoIdTamano = "") {
        $this->id = $id;
        $this->precioHora = $precioHora;
        $this->paseadorIdPaseador = $paseadorIdPaseador;
        $this->tamanoIdTamano = $tamanoIdTamano;
    }
    public function consultarPorPaseador($idPaseador) {
        return "SELECT t.idTarifa, t.PrecioHora, t.Paseador_idPaseador, t.Tamaño_idTamaño, tam.Tipo
                FROM Tarifa t
                INNER JOIN Tamaño tam ON t.Tamaño_idTamaño = tam.idTamaño
                WHERE t.Paseador_idPaseador = '" . $idPaseador . "'
                ORDER BY tam.Tipo ASC"; 
    }
}
?>
<?php

class Producto {
    public $id;
    public $nombre_Productos; // Actualizado para reflejar el nombre de la columna
    public $Proovedor_idProovedor; // ID del proveedor
    public $Administrador_idAdministrador; // ID del administrador
    public $precio;
    public $stock;
    public $Fecha_de_registro; // Puedes manejar la fecha en PHP o dejar que MySQL lo asigne automáticamente

    // Constructor
    public function __construct($_id, $_nombre_Productos, $_Proovedor_idProovedor, $_Administrador_idAdministrador, $_precio, $_stock, $_Fecha_de_registro = null) {
        $this->id = $_id;
        $this->nombre_Productos = $_nombre_Productos;
        $this->Proovedor_idProovedor = $_Proovedor_idProovedor;
        $this->Administrador_idAdministrador = $_Administrador_idAdministrador;
        $this->precio = $_precio;
        $this->stock = $_stock;
        $this->Fecha_de_registro = $_Fecha_de_registro ? $_Fecha_de_registro : date('Y-m-d H:i:s'); // Fecha actual por defecto
    }
}

?>

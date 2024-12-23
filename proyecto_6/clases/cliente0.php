<?php
class Cliente {
    public $idClientes;
    public $NomCliente;
    public $Apellido_paterno;
    public $Apellido_materno;
   
    public $TelCliente;
    public $domcliente;
    

    public function __construct($idClientes, $NomCliente, $Apellido_paterno, $Apellido_materno ,$TelCliente, $domcliente) {
        $this->idClientes = $idClientes;
        $this->NomCliente = $NomCliente;
        $this->Apellido_paterno= $Apellido_paterno;
        $this->Apellido_materno= $Apellido_materno ;
        $this->TelCliente = $TelCliente;
        $this->domcliente = $domcliente;
    }

  
    public function obtenerTarjetaHTML() {
        return '
            <div class="card m-2" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">ID: ' . htmlspecialchars($this->idClientes) . '</h5>
                    <p class="card-text">Nombre: ' . htmlspecialchars($this->NomCliente) . '</p>
                    <p class="card-text">Apellido Paterno: ' . htmlspecialchars($this->Apellido_paterno) . '</p>
                     <p class="card-text">Apellido Materno: ' . htmlspecialchars($this->Apellido_materno) . '</p>
                    <p class="card-text">Teléfono: ' . htmlspecialchars($this->TelCliente) . '</p>
                    <p class="card-text">Domicilio: ' . htmlspecialchars($this->domcliente) . '</p>
                </div>
               
            </div> ';
    }


}
?>
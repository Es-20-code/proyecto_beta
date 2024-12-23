<?php
class Loggin1 {
    public $idUsser;
    public $nom_usser;
    public $Tipo_usser;
    public $email;
    public $password_loggin;

    public function __construct($idUsser, $nom_usser, $Tipo_usser, $email, $password_loggin) {
        $this->idUsser = $idUsser;
        $this->nom_usser = $nom_usser;
        $this->Tipo_usser = $Tipo_usser;
        $this->email = $email;
        $this->password_loggin = $password_loggin;
    }

    public function ingreso() {
        return '<div class="ingreso m-2" style="width: 18rem;">
                    <div class="ingreso">
                        <p class="ingreso-email">Nombre: ' . htmlspecialchars($this->nom_usser) . '</p>
                        <p class="ingreso-tipo">Tipo de usuario: ' . htmlspecialchars($this->Tipo_usser) . '</p>
                        <p class="ingreso-email">Email: ' . htmlspecialchars($this->email) . '</p>
                        <p class="ingreso-pass">Contraseña: ' . htmlspecialchars($this->password_loggin) . '</p>
                    </div>
                </div>';
    }
}
?>

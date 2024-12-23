<?php
session_start(); // Iniciar sesión

// Destruir la sesión
session_unset();
session_destroy();

// Redirigir al inicio de sesión
header("Location: ../comm/loggin.php");
exit();
?>

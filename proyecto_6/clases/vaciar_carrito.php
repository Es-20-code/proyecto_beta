<?php
session_start();
unset($_SESSION['carrito']);
header('Location: ../comm/venta.php');
exit();
?>

<?php
session_start();
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = intval($_POST['id_producto']);
    $cantidad = intval($_POST['cantidad']);
    $precio_unitario = floatval($_POST['precio_unitario']);
    $descuento = floatval($_POST['descuento']);

    // Verificar si el carrito ya existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Consultar el stock disponible del producto
    $query = "SELECT Stock FROM productos WHERE Id_Producto = $id_producto";
    $result = $mysqli->query($query);
    $producto = $result->fetch_assoc();

    if ($cantidad > $producto['Stock']) {
        echo "<script>alert('Cantidad seleccionada supera el stock disponible.');</script>";
        header('Location: ../productos.php');
        exit();
    }

    // Calcular el subtotal con descuento aplicado
    $subtotal = $precio_unitario * $cantidad;

    // Verificar si el producto ya está en el carrito
    if (isset($_SESSION['carrito'][$id_producto])) {
        $_SESSION['carrito'][$id_producto]['cantidad'] += $cantidad;
        $_SESSION['carrito'][$id_producto]['subtotal'] += $subtotal;
    } else {
        $_SESSION['carrito'][$id_producto] = [
            'cantidad' => $cantidad,
            'subtotal' => $subtotal,
            'precio_unitario' => $precio_unitario,
            'descuento' => $descuento
        ];
    }

    header('Location: ../productos.php');
    exit();
}
?>

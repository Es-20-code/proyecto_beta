<?php
session_start();
include '../conexion/conexion.php';

// Verificar si el carrito no está vacío
if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
    $idLogincliente = $_SESSION['idLogincliente']; // Suponiendo que el cliente está logueado y su ID está en la sesión
    $Nombre_cliente = $_SESSION['nombre_cliente'];  // Nombre del cliente también desde la sesión
    $Domicilio = $_SESSION['domicilio'];            // Domicilio desde la sesión

    foreach ($_SESSION['carrito'] as $id_producto => $detalle) {
        $precio = $detalle['precio_unitario'];
        $cantidad = $detalle['cantidad'];
        $subtotal = $detalle['subtotal'];

        // Insertar cada producto como una fila en la tabla `factura`
        $sql = "INSERT INTO factura (idproducto, precio, idLogincliente, Nombre_cliente, Domicilio) 
                VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("idiss", $id_producto, $subtotal, $idLogincliente, $Nombre_cliente, $Domicilio);
            if (!$stmt->execute()) {
                echo "Error al registrar el producto $id_producto: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $conn->error;
        }
    }

    // Vaciar el carrito después de procesar la compra
    unset($_SESSION['carrito']);
    echo '<div class="container mt-5">';
    echo '<h2 class="text-center" style="color : white">Compra procesada correctamente.</h2>';
    echo '<a href="../productos.php" class="btn btn-primary">Regresar a Productos</a>';
    echo '</div>';
} else {
    echo '<div class="container mt-5">';
    echo '<p class="text-center" style="color : white">El carrito está vacío.</p>';
    echo '</div>';
}

$conn->close();
?>

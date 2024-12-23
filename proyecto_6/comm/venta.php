<?php
session_start();
include '../conexion/conexion.php';

echo '<div class="container mt-5">';
echo '<h2 class="text-center" style="color : white">Carrito de Compras</h2>';

if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
    echo '<table class="table table-striped">';
    echo '<thead><tr><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Subtotal</th></tr></thead>';
    echo '<tbody>';

    $total = 0;

    foreach ($_SESSION['carrito'] as $id_producto => $detalle) {
        $query = "SELECT Nombre_Productos FROM productos WHERE Id_Producto = $id_producto";
        $result = $mysqli->query($query);
        $producto = $result->fetch_assoc();

        echo '<tr>';
        echo '<td>' . $producto['Nombre_Productos'] . '</td>';
        echo '<td>' . $detalle['cantidad'] . '</td>';
        echo '<td>$' . number_format($detalle['precio_unitario'], 2) . '</td>';
        echo '<td>$' . number_format($detalle['subtotal'], 2) . '</td>';
        echo '</tr>';

        $total += $detalle['subtotal'];
    }

    echo '</tbody>';
    echo '</table>';
    echo '<h4 style= "color : white">Total: $' . number_format($total, 2) . '</h4>';
    echo '<a href="../productos.php" class="btn btn-primary">Seguir Comprando</a>';
    echo '<a href="../clases/vaciar_carrito.php" class="btn btn-danger">Vaciar Carrito</a>';
    echo '<a href="../clases/procesar_compra.php" class="btn btn-success">Comprar</a>';

} else {
    echo '<p class="text-center" style="color : white" >El carrito está vacío.</p>';
}

echo '</div>';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .body {background-color:   #722F37; }
        
     

    </style>
</head>
<body class="body">

<a href="../pagina_inicial.php" class="btn btn-primary">Ir a pagina principal</a>

</body>
</html>
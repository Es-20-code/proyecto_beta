<?php
   
   include("./comm/ini.php");
include './conexion/conexion.php';

// Obtener productos activos
$query = "SELECT Id_Producto, Nombre_Productos, Precio, Stock, Descuento 
          FROM productos 
          WHERE Estado = 1";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    echo '<div class="container mt-5">';
    echo '<h2 class="text-center" style="color: wheat">Productos Disponibles</h2>';
    echo '<div class="row">';

    while ($row = $result->fetch_assoc()) {
        $precio_final = $row['Precio'] - ($row['Precio'] * ($row['Descuento'] / 100));
        echo '<div class="col-md-4">';
        echo '<div class="card mb-4">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['Nombre_Productos'] . '</h5>';
        echo '<p class="card-text">Precio unitario: $' . number_format($precio_final, 2) . '</p>';
        echo '<p class="card-text">Stock disponible: ' . $row['Stock'] . '</p>';
        echo '<form method="POST" action="./clases/agregar_carrito.php">';
        echo '<input type="hidden" name="id_producto" value="' . $row['Id_Producto'] . '">';
        echo '<input type="hidden" name="precio_unitario" value="' . $precio_final . '">';
        echo '<input type="hidden" name="descuento" value="' . $row['Descuento'] . '">';
        echo '<div class="mb-3">';
        echo '<label for="cantidad_' . $row['Id_Producto'] . '" class="form-label">Cantidad:</label>';
        echo '<input type="number" name="cantidad" id="cantidad_' . $row['Id_Producto'] . '" class="form-control" min="1" max="' . $row['Stock'] . '" required>';
        echo '</div>';
        echo '<button type="submit" class="btn btn-primary">Agregar al carrito</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';
    echo '</div>';
} else {
    echo '<p class="text-center mt-5">No hay productos disponibles.</p>';
}

$mysqli->close();
?>





<?php
   
   include("./comm/pie_pag.php");
?>



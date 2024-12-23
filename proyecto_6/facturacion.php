<?php
   
   include("./comm/ini.php");
?>

<?php
// Incluye el archivo de conexión
require_once './conexion/conexion.php';

// Verifica si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura los datos enviados desde el formulario
    $idproducto = $_POST['idproducto'];
    $precio = $_POST['precio'];
    $idLogincliente = $_POST['idLogincliente'];
    $Nombre_cliente = $_POST['Nombre_cliente'];
    $Domicilio = $_POST['Domicilio'];

    // Valida que todos los datos estén completos
    if (!empty($idproducto) && !empty($precio) && !empty($idLogincliente) && !empty($Nombre_cliente) && !empty($Domicilio)) {
        // Prepara la consulta SQL para insertar los datos
        $sql = "INSERT INTO factura (idproducto, precio, idLogincliente, Nombre_cliente, Domicilio) 
                VALUES (?, ?, ?, ?, ?)";

        // Prepara la declaración
        if ($stmt = $conn->prepare($sql)) {
            // Vincula los parámetros
            $stmt->bind_param("idiss", $idproducto, $precio, $idLogincliente, $Nombre_cliente, $Domicilio);

            // Ejecuta la consulta
            if ($stmt->execute()) {
                echo "Factura registrada correctamente.";
            } else {
                echo "Error al registrar la factura: " . $stmt->error;
            }

            // Cierra la declaración
            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $conn->error;
        }
    } else {
        echo "Por favor completa todos los campos.";
    }

    // Cierra la conexión
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Factura</title>
</head>
<body>
    <h1>Registrar Factura</h1>
    <form action="facturar.php" method="POST">
        <label for="idproducto">ID Producto:</label>
        <input type="number" name="idproducto" id="idproducto" required><br>

        <label for="precio">Precio:</label>
        <input type="number" step="0.01" name="precio" id="precio" required><br>

        <label for="idLogincliente">ID Login Cliente:</label>
        <input type="number" name="idLogincliente" id="idLogincliente" required><br>

        <label for="Nombre_cliente">Nombre del Cliente:</label>
        <input type="text" name="Nombre_cliente" id="Nombre_cliente" required><br>

        <label for="Domicilio">Domicilio:</label>
        <input type="text" name="Domicilio" id="Domicilio" required><br>

        <button type="submit">Registrar Factura</button>
    </form>
</body>
</html>



<?php
   
   include("./comm/pie_pag.php");
?>



<?php
// Definir que la respuesta a la petición es un JSON
header('Content-Type: application/json; charset=utf-8');

// Incluir la clase Producto
include("../clases/producto.php");

// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "123456", "proyectof6");
if (!$conexion) {
    die(json_encode(["success" => false, "message" => "Error de conexión a la base de datos: " . mysqli_connect_error()]));
}

// Obtener la acción de la petición
$accion = $_SERVER['REQUEST_METHOD'];

switch ($accion) {
    case 'POST':  // Crear o Actualizar
        $datos = json_decode(file_get_contents("php://input"), true);
        if (isset($datos['action']) && $datos['action'] === 'update') {
            _update($datos);
        } else {
            _create($datos);
        }
        break;

    case 'GET':   // Leer
        if (isset($_GET['id'])) {
            _read_single($_GET['id']);
        } else {
            _read();
        }
        break;

    case 'DELETE':   // Eliminar
        $datos = json_decode(file_get_contents("php://input"), true);
        _delete($datos);
        break;

    default:    // Otro método no definido
        header('HTTP/1.1 405 Method Not Allowed');
        header('Allow: GET, POST, DELETE');
        echo json_encode(["success" => false, "message" => "Método no permitido"]);
        break;
}

// Crear un nuevo producto
function _create($datos) {
    global $conexion;

    $nombre_Productos = $datos['Nombre_Productos'] ?? null; // Cambiado para reflejar el nombre correcto
    $proveedor_idProovedor = $datos['Proovedor_idProovedor'] ?? null; // ID del proveedor
    $administrador_idAdministrador = $datos['Administrador_idAdministrador'] ?? null; // ID del administrador
    $precio = $datos['Precio'] ?? null; // Precio
    $stock = $datos['Stock'] ?? null; // Stock

    // Verificar que todos los campos obligatorios están presentes
    if (!$nombre_Productos || !$proveedor_idProovedor || !$administrador_idAdministrador || !$precio || !$stock) {
        echo json_encode(["success" => false, "message" => "Faltan campos obligatorios"]);
        return;
    }

    // Consulta para insertar el nuevo producto
    $query = "INSERT INTO productos (Nombre_Productos, Proovedor_idProovedor, Administrador_idAdministrador, Precio, Stock, Fecha_de_registro) 
              VALUES ('$nombre_Productos', $proveedor_idProovedor, $administrador_idAdministrador, $precio, $stock, NOW())";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $query)) {
        echo json_encode(["success" => true, "message" => "Producto creado exitosamente"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al crear el producto: " . mysqli_error($conexion)]);
    }
}

// Leer todos los productos
function _read() {
    global $conexion;

    $query = "SELECT * FROM productos";
    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        echo json_encode(["success" => false, "message" => "Error al obtener productos: " . mysqli_error($conexion)]);
        return;
    }

    $productos = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $productos[] = $row;
    }

    echo json_encode(["success" => true, "data" => $productos]);
}

// Leer un producto específico
function _read_single($id) {
    global $conexion;

    $query = "SELECT * FROM productos WHERE Id_Producto = $id"; // Cambiado el nombre de la columna 'id'
    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        echo json_encode(["success" => false, "message" => "Error al obtener el producto: " . mysqli_error($conexion)]);
        return;
    }

    $producto = mysqli_fetch_assoc($resultado);
    if ($producto) {
        echo json_encode(["success" => true, "data" => [$producto]]);
    } else {
        echo json_encode(["success" => false, "message" => "Producto no encontrado"]);
    }
}

// Actualizar un producto existente
function _update($datos) {
    global $conexion;

    $id = $datos['id'] ?? null;
    $nombre_Productos = $datos['Nombre_Productos'] ?? null; // Cambiado para reflejar el nombre correcto
    $proveedor_idProovedor = $datos['Proovedor_idProovedor'] ?? null; // ID del proveedor
    $administrador_idAdministrador = $datos['Administrador_idAdministrador'] ?? null; // ID del administrador
    $precio = $datos['Precio'] ?? null; // Precio
    $stock = $datos['Stock'] ?? null; // Stock

    // Verificar que todos los campos obligatorios estén presentes
    if (!$id || !$nombre_Productos || !$proveedor_idProovedor || !$administrador_idAdministrador || !$precio || !$stock) {
        echo json_encode(["success" => false, "message" => "Faltan campos obligatorios"]);
        return;
    }

    // Consulta para actualizar el producto
    $query = "UPDATE productos 
              SET Nombre_Productos='$nombre_Productos', Proovedor_idProovedor=$proveedor_idProovedor, Administrador_idAdministrador=$administrador_idAdministrador, Precio=$precio, Stock=$stock 
              WHERE Id_Producto=$id";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $query)) {
        echo json_encode(["success" => true, "message" => "Producto actualizado exitosamente"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al actualizar el producto: " . mysqli_error($conexion)]);
    }
}

// Eliminar un producto
function _delete($datos) {
    global $conexion;

    $id = $datos['id'] ?? null;

    if (!$id) {
        echo json_encode(["success" => false, "message" => "ID no proporcionado"]);
        return;
    }

    $query = "DELETE FROM productos WHERE Id_Producto = $id"; // Cambiado el nombre de la columna 'id'
    if (mysqli_query($conexion, $query)) {
        echo json_encode(["success" => true, "message" => "Producto eliminado exitosamente"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al eliminar el producto: " . mysqli_error($conexion)]);
    }
}

mysqli_close($conexion);
?>

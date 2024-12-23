<?php
header('Content-Type: application/json; charset=utf-8');
include("loggin0.php");

$postBody = file_get_contents("php://input");
$data = $postBody ? json_decode($postBody) : null;

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        _post($data);
        break;
    case 'GET':
        _get();
        break;
    case 'PUT':
        _puts($data);
        break;
    case 'DELETE':
        _delete($data);
        break;
    default:
        header('HTTP/1.1 405 Method Not Allowed');
        echo json_encode(["error" => "Método no permitido"]);
        break;
}

// Función Create
function _post($datos) {
    include("../conexion/conexion.php");

    $respuesta = ["success" => false];

    // Validar que los datos no sean nulos
    if (is_null($datos)) {
        $respuesta["error"] = "El cuerpo de la solicitud está vacío o malformado.";
        echo json_encode($respuesta);
        return;
    }

    // Validar que las propiedades necesarias están presentes
    if (!isset($datos->nom_usser, $datos->Tipo_usser, $datos->email, $datos->password_loggin)) {
        $respuesta["error"] = "Faltan datos requeridos en la solicitud.";
        echo json_encode($respuesta);
        return;
    }

    try {
        // Preparar la consulta
        if ($stmt = $mysqli->prepare("INSERT INTO loggin (nom_usser, Tipo_usser, email, password_loggin) VALUES (?, ?, ?, ?)")) {
            $stmt->bind_param("ssss", $datos->nom_usser, $datos->Tipo_usser, $datos->email, $datos->password_loggin);
            $stmt->execute();

            $respuesta["success"] = true;
            $stmt->close();
        } else {
            $respuesta["error"] = "Error en la consulta: " . $mysqli->error;
        }
    } catch (Exception $e) {
        $respuesta["error"] = "Excepción: " . $e->getMessage();
    }

    echo json_encode($respuesta);
}

// Función Read
function _get() {
    include("../conexion/conexion.php");
    $respuesta = [];

    try {
        if (isset($_GET["loggin"])) {
            if ($stmt = $mysqli->prepare("SELECT idUsser, nom_usser, Tipo_usser, email, password_loggin FROM loggin WHERE idUsser = ?")) {
                $stmt->bind_param("i", $_GET["loggin"]);
                $stmt->execute();
            }
        } else {
            if ($stmt = $mysqli->prepare("SELECT idUsser, nom_usser, Tipo_usser, email, password_loggin FROM loggin")) {
                $stmt->execute();
            }
        }

        if (isset($stmt)) {
            $stmt->bind_result($idUsser, $nom_usser, $Tipo_usser, $email, $password_loggin);
            while ($stmt->fetch()) {
                $registro_loggin = new Loggin1($idUsser, $nom_usser, $Tipo_usser, $email, $password_loggin);
                $respuesta[] = $registro_loggin;
            }
            $stmt->close();
        }
    } catch (Exception $e) {
        echo json_encode(["error" => $e->getMessage()]);
        return;
    }

    echo json_encode($respuesta);
}

// Función Update
function _puts($datos) {
    include("../conexion/conexion.php");
    $respuesta = ["success" => false];

    if (isset($datos->loggin, $datos->nom_usser, $datos->Tipo_usser, $datos->email)) {
        try {
            if ($stmt = $mysqli->prepare("UPDATE loggin SET nom_usser = ?, Tipo_usser = ?, email = ? WHERE idUsser = ?")) {
                $stmt->bind_param("sssi", $datos->nom_usser, $datos->Tipo_usser, $datos->email, $datos->loggin);
                $stmt->execute();
                $respuesta["success"] = true;
                $stmt->close();
            } else {
                $respuesta["error"] = "Error en la consulta: " . $mysqli->error;
            }
        } catch (Exception $e) {
            $respuesta["error"] = $e->getMessage();
        }
    } else {
        $respuesta["error"] = "Faltan datos requeridos";
    }

    echo json_encode($respuesta);
}

// Función Delete
function _delete($datos) {
    include("../conexion/conexion.php");
    $respuesta = ["success" => false];

    if (isset($datos->loggin)) {
        try {
            if ($stmt = $mysqli->prepare("UPDATE loggin SET estado = 0 WHERE idUsser = ?")) {
                $stmt->bind_param("i", $datos->loggin);
                $stmt->execute();
                $respuesta["success"] = true;
                $stmt->close();
            } else {
                $respuesta["error"] = "Error en la consulta: " . $mysqli->error;
            }
        } catch (Exception $e) {
            $respuesta["error"] = $e->getMessage();
        }
    } else {
        $respuesta["error"] = "Faltan datos requeridos";
    }

    echo json_encode($respuesta);
}
?>

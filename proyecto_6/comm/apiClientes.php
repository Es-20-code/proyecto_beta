<?php
// Definir que la respuesta a la petición es un JSON
header('Content-Type: application/json; charset=utf-8');

// Incluir la clase Cliente
include("../clases/cliente0.php");

// Obtener el contenido de la petición
$postBody = file_get_contents("php://input");
$data = isset($postBody) ? json_decode($postBody) : null;

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        _post($data);
        break;
    case 'GET':
        _get();
        break;
    case 'PUT':
        _put($data);
        break;
    case 'DELETE':
        _delete($data);
        break;
    default:
        header('HTTP/1.1 405 Method Not Allowed');
        header('Allow: GET, PUT, DELETE, POST');
        break;
}

function _post($datos) {
    $respuesta = 0;

    include("../conexion/conexion.php");

    try {
        if (
            isset($datos->Nombre_cliente) &&
            isset($datos->Apellido_paterno) &&
            isset($datos->Apellido_materno) &&
            isset($datos->Numero_telefonico_del_cliente) &&
            isset($datos->Domicilio)
        ) {
            if ($stmt = $mysqli->prepare("INSERT INTO cliente (Nombre_cliente, Apellido_paterno, Apellido_materno, Numero_telefonico_del_cliente, Domicilio) VALUES (?, ?, ?, ?, ?);")) {
                $stmt->bind_param(
                    "sssss",
                    $datos->Nombre_cliente,
                    $datos->Apellido_paterno,
                    $datos->Apellido_materno,
                    $datos->Numero_telefonico_del_cliente,
                    $datos->Domicilio
                );

                $stmt->execute();
                $stmt->close();
                $respuesta = 1;
            }
        }
    } catch (Exception $e) {
        echo "Exception :: " . $e->getMessage();
    } finally {
        $mysqli->close();
    }

    echo json_encode($respuesta);
}

function _get() {
    include("../conexion/conexion.php");
    $stmt = null;
    $respuesta = array();

    try {
        if (isset($_GET["Cliente"])) {
            if ($stmt = $mysqli->prepare("SELECT idLogincliente, Nombre_cliente, Apellido_paterno, Apellido_materno, Numero_telefonico_del_cliente, Domicilio FROM cliente WHERE idLogincliente = ?;")) {
                $stmt->bind_param("i", $_GET["Cliente"]);
                $stmt->execute();
            }
        } else {
            if ($stmt = $mysqli->prepare("SELECT idLogincliente, Nombre_cliente, Apellido_paterno, Apellido_materno, Numero_telefonico_del_cliente, Domicilio FROM cliente;")) {
                $stmt->execute();
            }
        }

        if (isset($stmt)) {
            $stmt->bind_result($idLogincliente, $Nombre_cliente, $Apellido_paterno, $Apellido_materno, $Numero_telefonico_del_cliente, $Domicilio);

            while ($stmt->fetch()) {
                $registro_cliente = new Cliente($idLogincliente, $Nombre_cliente, $Apellido_paterno, $Apellido_materno, $Numero_telefonico_del_cliente, $Domicilio);

                array_push($respuesta, $registro_cliente);
            }

            $stmt->free_result();
            $stmt->close();
        }
    } catch (Exception $e) {
        echo "Exception :: " . $e->getMessage();
    } finally {
        $mysqli->close();
    }

    echo json_encode($respuesta);
}

function _put($datos) {
    $respuesta = 0;

    if (
        isset($datos->idLogincliente) &&
        isset($datos->Nombre_cliente) &&
        isset($datos->Apellido_paterno) &&
        isset($datos->Apellido_materno) &&
        isset($datos->Numero_telefonico_del_cliente) &&
        isset($datos->Domicilio)
    ) {
        include("../conexion/conexion.php");

        try {
            if ($stmt = $mysqli->prepare("UPDATE cliente SET Nombre_cliente = ?, Apellido_paterno = ?, Apellido_materno = ?, Numero_telefonico_del_cliente = ?, Domicilio = ? WHERE idLogincliente = ?;")) {
                $stmt->bind_param(
                    "sssssi",
                    $datos->Nombre_cliente,
                    $datos->Apellido_paterno,
                    $datos->Apellido_materno,
                    $datos->Numero_telefonico_del_cliente,
                    $datos->Domicilio,
                    $datos->idLogincliente
                );

                $stmt->execute();
                $stmt->close();
                $respuesta = 1;
            }
        } catch (Exception $e) {
            echo "Exception :: " . $e->getMessage();
        } finally {
            $mysqli->close();
        }
    } else {
        die("Error: Datos incompletos.");
    }

    echo json_encode($respuesta);
}

function _delete($datos) {
    $respuesta = 0;

    if (isset($datos->idLogincliente)) {
        include("../conexion/conexion.php");

        try {
            if ($stmt = $mysqli->prepare("DELETE FROM cliente WHERE idLogincliente = ?;")) {
                $stmt->bind_param("i", $datos->idLogincliente);
                $stmt->execute();
                $stmt->close();
                $respuesta = 1;
            }
        } catch (Exception $e) {
            echo "Exception :: " . $e->getMessage();
        } finally {
            $mysqli->close();
        }
    } else {
        die("Error: Datos incompletos.");
    }

    echo json_encode($respuesta);
}
?>

<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "12345678", "proyectof6");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y recibir los datos del formulario
    $usuario = mysqli_real_escape_string($conexion, trim($_POST['usuario']));
    $email = mysqli_real_escape_string($conexion, trim($_POST['email']));
    $password = mysqli_real_escape_string($conexion, trim($_POST['password']));
    $tipo = intval($_POST['tipo']);

    // Validar que todos los campos estén llenos y que la contraseña no supere los 8 caracteres
    if (!empty($usuario) && !empty($email) && !empty($password) && $tipo > 0) {
        if (strlen($password) <= 8) {
            // Verificar que el usuario o email no exista
            $query = "SELECT * FROM loggin WHERE nom_usser = '$usuario' OR email = '$email'";
            $resultado = mysqli_query($conexion, $query);

            if (mysqli_num_rows($resultado) == 0) {
                // Insertar el nuevo usuario en la base de datos
                $insertar = "INSERT INTO loggin (nom_usser, email, password_loggin, Tipo_usser, idTipo) 
                             VALUES ('$usuario', '$email', '$password', 
                             CASE WHEN $tipo = 1 THEN 'cliente' ELSE 'proovedor' END, $tipo)";
                if (mysqli_query($conexion, $insertar)) {
                    $mensajeExito = "Usuario creado exitosamente.";
                } else {
                    $error = "Error al crear el usuario: " . mysqli_error($conexion);
                }
            } else {
                $error = "El nombre de usuario o el correo electrónico ya está en uso.";
            }
        } else {
            $error = "La contraseña no puede tener más de 8 caracteres.";
        }
    } else {
        $error = "Por favor, complete todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .body {
            background-color: #722F37;
        }
        .h3 {
            color: wheat;
        }
        .mb-3 {
            background-color: #fdddca;
        }
    </style>
</head>
<body class="body">
    <div class="container mt-5">
        <h3 class="h3">Crear un nuevo usuario</h3>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre de usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" maxlength="8" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de usuario</label>
                <select class="form-control" id="tipo" name="tipo" required>
                    <option value="1">Cliente</option>
                    <option value="3">Proovedor</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Crear Usuario</button>
        </form>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php elseif (isset($mensajeExito)): ?>
            <div class="alert alert-success mt-3" role="alert">
                <?= htmlspecialchars($mensajeExito) ?>
            </div>
        <?php endif; ?>
    </div>
    <a href="../pagina_inicial.php" class="btn btn-primary">Regresar a la página principal</a>
</body>
</html>

<?php
session_start(); // Iniciar sesión

// Verificar que el usuario haya iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../comm/loggin.php");
    exit();
}

// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "12345678", "proyectof6");

// Obtener el usuario actual de la sesión
$usuarioActual = $_SESSION['usuario'];

// Si se envía el formulario para actualizar el perfil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevoUsuario = mysqli_real_escape_string($conexion, trim($_POST['usuario']));
    $nuevoEmail = mysqli_real_escape_string($conexion, trim($_POST['email']));
    $nuevaPassword = mysqli_real_escape_string($conexion, trim($_POST['password']));

    // Validar que los campos no estén vacíos
    if (!empty($nuevoUsuario) && !empty($nuevoEmail)) {
        // Construir consulta para actualizar datos
        $consulta = "UPDATE loggin 
                     SET nom_usser = '$nuevoUsuario', email = '$nuevoEmail'";
        
        if (!empty($nuevaPassword)) {
            $consulta .= ", password_loggin = '$nuevaPassword'";
        }
        
        $consulta .= " WHERE nom_usser = '$usuarioActual'";

        // Ejecutar la consulta
        if (mysqli_query($conexion, $consulta)) {
            // Actualizar el nombre de usuario en la sesión
            $_SESSION['usuario'] = $nuevoUsuario;
            $mensajeExito = "Perfil actualizado correctamente.";
            $usuarioActual = $nuevoUsuario;
        } else {
            $error = "Error al actualizar el perfil: " . mysqli_error($conexion);
        }
    } else {
        $error = "El nombre de usuario y el email son obligatorios.";
    }
}

// Obtener los datos actuales del usuario
$consultaUsuario = "SELECT * FROM loggin WHERE nom_usser = '$usuarioActual'";
$resultado = mysqli_query($conexion, $consultaUsuario);
$datosUsuario = mysqli_fetch_assoc($resultado);

mysqli_close($conexion); // Cerrar conexión
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
        .container{color: white;}
        .text-center { color: wheat }
     

    </style>
</head>
<body class="body">

    <div class="container mt-5">
        <h2 class="text-center">Perfil de Usuario</h2>
        
        <?php if (isset($mensajeExito)): ?>
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars($mensajeExito) ?>
            </div>
        <?php elseif (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" value="<?= htmlspecialchars($datosUsuario['nom_usser']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($datosUsuario['email']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Nueva Contraseña</label>
                <input type="password" class="form-control" id="password" name="password">
                <small class="card form-text text-muted" >Deja este campo vacío si no deseas cambiar tu contraseña.</small>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
            <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
        </form>
    </div>
<p></p>
    <a href="../pagina_inicial.php" class="btn btn-primary">Ir a pagina principal</a>

</body>
</html>

<?php
// Iniciar sesión
session_start();

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "12345678", "proyectof6");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el nombre de usuario y la contraseña del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['password'];

    // Consulta para verificar usuario
    $consulta = "SELECT * FROM loggin WHERE nom_usser = '$usuario' AND password_loggin = '$contrasena'";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $filas = mysqli_fetch_array($resultado);

        // Establecer variables de sesión al iniciar sesión
        $_SESSION['usuario'] = $usuario; // Guardamos el nombre de usuario en la sesión
        $_SESSION['idTipo'] = $filas['idTipo']; // Guardamos el tipo de usuario

        // Redirección según el tipo de usuario
        if ($filas['idTipo'] == 1) {
            header("Location: ../pagina_inicial.php");
            exit();
        } else if ($filas['idTipo'] == 2) {
            header("Location: admin.php");
            exit();
        } else if ($filas['idTipo'] == 3) {
            header("Location: proovedores.php");
            exit();
        }
    } else {
        $error = "Error en la autenticación de credenciales.";
    }

    // Liberar el resultado y cerrar la conexión
    mysqli_free_result($resultado);
    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bodega de oro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .nav-underline {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh;
        }
        .body {
            background-color: #722F37;
        }

        .card{ background-color: wheat}

       </style>
</head>
<body class="body">
    <ul class="nav nav-underline">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#" style="color: wheat">Bienvenido</a>
        </li>
        
    </ul>

    <div class="card w-75 mb-3 mx-auto">
        <div class="card-body text-center">
            <h5 class="card-title">Ingresar usuario</h5>
            <form method="POST" action="">
                <p><input type="text" name="usuario" required="required" placeholder="Usuario"></p>
                <h5 class="card-title">Ingresar contraseña</h5>
                <p><input type="password" name="password" required="required" placeholder="Contraseña"></p>
                <button type="submit" class="btn btn-primary">Ingresar</button>
                <a href="recuperar_contra.php" class="btn btn-primary">Recuperar contraseña</a>
            </form>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <a href="crear_user.php" class="btn btn-primary">Registrar</a>
</body>
</html>

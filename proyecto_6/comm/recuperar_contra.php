<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "12345678", "proyectof6");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];

    // Verificar si el usuario existe
    $consulta = "SELECT * FROM loggin WHERE nom_usser = '$usuario'";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        // Generar nueva contraseña de 8 números
        $nuevaPassword = strval(rand(10000000, 99999999)); // Número de 8 dígitos

        // Actualizar contraseña en la base de datos
        $update = "UPDATE loggin SET password_loggin = '$nuevaPassword' WHERE nom_usser = '$usuario'";
        mysqli_query($conexion, $update);

        // Mostrar la nueva contraseña
        $mensajeExito = "Tu nueva contraseña temporal es: <strong>$nuevaPassword</strong>. Por favor, cámbiala después de iniciar sesión.";
    } else {
        $error = "El usuario no existe.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recuperar contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        

        .h3 {
            color: wheat;
        }

        .nav-underline .nav-link.active {
            color: #fdddca;
        }

        .body {
            background-color: #722F37;
        }

        .mb-3 {
            background-color: #fdddca;
        }
    </style>

</head>
<body class="body">
    <div class="container mt-5">
        <h3 class="h3">Recuperar contraseña</h3>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre de usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <button type="submit" class="btn btn-primary">Recuperar contraseña</button>
        </form>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php elseif (isset($mensajeExito)): ?>
            <div class="alert alert-success mt-3" role="alert">
                <?= $mensajeExito ?>
            </div>
        <?php endif; ?>
    </div>

    <a href="../pagina_inicial.php"class="btn btn-primary">Regresar a pagina prinpal</a>
</body>
</html>

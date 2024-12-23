<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .nav-underline {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh;
        }
        .nav-underline .nav-link {
            color: wheat;
        }
        .nav-underline .nav-link.active {
            color: #fdddca;
        }
        .body {
            background-color: #722F37;
        }
        .costum-card {
            background-color: #fdddca;
        }
    </style>
</head>
<body class="body">
<ul class="nav nav-underline">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="adm_report.php">Administración de reportes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="adm_product.php">Administración del producto</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../admin.php">Administración de los clientes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../clases/perfil.php">Personalizar sesión</a>
    </li>
</ul>

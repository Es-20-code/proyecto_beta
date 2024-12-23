<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bodega de oro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--Script para Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        h1 {
            color: gold; /* Color dorado oscuro */
        }
        body {
          background-color: #722F37;   /* Color de fondo  */
            position: relative;
        }

        .icon-container {
    display: flex; /* Usa flexbox para alinear los íconos */
    justify-content: flex-end; /* Alinea los íconos a la derecha */
    align-items: center; /* Alinea verticalmente los íconos */
    gap: 10px; /* Espacio entre los íconos */
}

.svg-icon {
    width: 30px; /* Ajusta el tamaño del SVG */
    height: 30px; /* Ajusta el tamaño del SVG */
    fill: white; /* Color del SVG */
   
}

.title-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh; 
        } 
      
        

        .custom-navbar {
    background-color: #fdddca; /* Cambia este valor al color que desees */
}


    </style>
</head>

<body>

<!-- <div class="title-container">
    <h1><p class="fs-1">Bodega de Oro</p></h1>
   </div>  -->

<div class="text-center">
  <img src="./img/Encabezado co.jpg" class="rounded" alt="Bodega_de_oro">
</div>

<div class="icon-container">
   <a href="./comm/venta.php">
       <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
           <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
       </svg>
   </a>
   <a href="./clases/perfil.php">
       <svg class="svg-icon login-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
           <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
       </svg>
   </a>
</div>


<nav class="navbar navbar-expand-lg custom-navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="../proyecto_6/pagina_inicial.php">Inicio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="../proyecto_6/productos.php">Productos</a>
        <a class="nav-link" href="../proyecto_6/facturacion.php">Facturacion</a>
        <a class="nav-link" href="../proyecto_6/reportes.php">Reportes</a>
        <a class="nav-link" href="../proyecto_6/proovedores.php">Proveedores</a>
        <a class="nav-link disabled" aria-disabled="true"></a>
      </div>
    </div>
  </div>
</nav>

<div class="px-3"><!--contenido-->

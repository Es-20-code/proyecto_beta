<?php
session_start(); // Inicia la sesión

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no hay un usuario en sesión, redirige al inicio de sesión
    header("Location: ./comm/loggin.php");
    exit(); // Detiene la ejecución del script
}

include("./comm/ini.php"); // Tu código de cabecera
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Bodega de Oro</title>
    <style>
        body {
            font-family: 'Times New Roman';
        }
        .A {
            color: white;
            font-size: 27px;
            font-family: 'Times New Roman';
        }
        .strong {
            font-family: 'Times New Roman';
        }
        
        .h1 {
            color: #fdddca;
            font-size: 50px;
            font-family: Garamond;
            text-align: center;
        }
       
        .left-align {
            text-align: left;
        }
        .center-align {
            text-align: center;
        }
        .image-left {
            float: left;
            margin-right: 10px;
            width: 45%;
        }
        .image-right {
            float: right;
            margin-left: 10px;
            width: 45%;
        }


    </style>
</head>
<body>
    <!-- Encabezado -->
    <h1 class="h1">¡Bienvenido a <em>Bodega de Oro</em>!</h1>

    <!-- Primer párrafo con imagen a la izquierda -->
    <div class="right-align" style="margin-top: 40px;">
        <img src="./img/ima1.jpg" class="image-left" alt="Imagen 1" style="margin-right: 20px">
        <p class="A" > 
            En Bodega de Oro, somos tu socio de <strong>confianza</strong> en la compraventa de licores, ofreciendo una amplia variedad de productos de las mejores marcas nacionales e internacionales. Nuestra misión es conectar a mayoristas y minoristas con bebidas de <strong>calidad certificada</strong>, garantizando una experiencia de compra confiable, eficiente y personalizada.
        </p>
    </div>

    <!-- Segundo párrafo con imagen a la derecha -->
    <div class="left-align" style="margin-top: 200px;">
        <img src="./img/ima2.jpg" class="image-right" alt="Imagen 2">
        <p class="A" style="margin-left: 10px;">
            Ya sea que estés buscando abastecer tu negocio o simplemente adquirir tus licores favoritos, en Bodega de Oro encontrarás un catálogo cuidadosamente seleccionado que satisface los gustos más exigentes. Nos enorgullece ser un puente entre tradición y modernidad, llevando a tu alcance la riqueza de <strong>los mejores destilados y vinos del mercado.</strong>
        </p>
    </div>

    <!-- Último párrafo centrado -->
    <div class="center-align" style="margin-top: 200px; margin-bottom: 80px; ">
        <p class="A">
            Explora nuestra página y descubre promociones exclusivas, asesoramiento experto y un servicio diseñado para superar tus expectativas. <strong>¡En Bodega de Oro, celebramos los grandes momentos contigo!</strong>

        </p>
        <a href="productos.php" class="btn btn-warning btn-block" style="--bs-btn-font-size: 2rem;" >Ver nuestros productos</a>
    </div>
   
</body>
</html>


<?php
include("./comm/pie_pag.php"); 
?>

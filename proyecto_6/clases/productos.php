<?php
session_start();

// Conexión a la base de datos utilizando mysqli
$conexion = mysqli_connect("localhost", "root", "123456", "proyectof6");

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Manejo de la lógica para agregar, editar y eliminar productos
if (isset($_POST['form_data'])) {
    // Recibir los datos del formulario
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $proveedor_id = mysqli_real_escape_string($conexion, $_POST['proveedor_id']);
    $administrador_id = mysqli_real_escape_string($conexion, $_POST['administrador_id']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $stock = mysqli_real_escape_string($conexion, $_POST['cantidad']);
    $fecha_registro = date('Y-m-d H:i:s');
    $id = isset($_POST['id']) ? mysqli_real_escape_string($conexion, $_POST['id']) : '';

    if ($id != "") {
        // Editar producto
        $query = "UPDATE productos 
                  SET Nombre_Productos='$nombre', Proovedor_idProovedor='$proveedor_id', Administrador_idAdministrador='$administrador_id', Stock='$stock', Precio='$precio', Fecha_de_registro='$fecha_registro' 
                  WHERE id=$id";
        $msg = "Producto actualizado exitosamente";
    } else {
        // Agregar nuevo producto
        $query = "INSERT INTO productos (Nombre_Productos, Proovedor_idProovedor, Administrador_idAdministrador, Stock, Precio, Fecha_de_registro) 
                  VALUES ('$nombre', '$proveedor_id', '$administrador_id', '$stock', '$precio', '$fecha_registro')";
        $msg = "Producto agregado exitosamente";
    }

    if (mysqli_query($conexion, $query)) {
        $_SESSION['flash_msg'] = $msg;
    } else {
        $_SESSION['flash_msg'] = "Error en la operación: " . mysqli_error($conexion);
    }

    header("Location: index.php");
    exit(); // Asegúrate de salir después de redirigir
}

if (isset($_GET['delete_id'])) {
    $id = mysqli_real_escape_string($conexion, $_GET['delete_id']);
    $query = "DELETE FROM productos WHERE id=$id";
    if (mysqli_query($conexion, $query)) {
        $_SESSION['flash_msg'] = "Producto eliminado exitosamente";
    } else {
        $_SESSION['flash_msg'] = "Error al eliminar el producto: " . mysqli_error($conexion);
    }
    header("Location: index.php");
    exit();
}

// Obtener productos
$result = mysqli_query($conexion, "SELECT * FROM productos");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="sb-nav-fixed">

    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Gestión de Productos</a>
        </div>
    </nav>

    <div class="container my-5 pt-5">
        <h2>Gestión de Productos</h2>
        
        <?php if (isset($_SESSION['flash_msg'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['flash_msg']; unset($_SESSION['flash_msg']); ?>
            </div>
        <?php endif; ?>

        <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#formModal">Agregar Producto</button>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Proveedor</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($producto = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $producto['id']; ?></td>
                        <td><?= $producto['Nombre_Productos']; ?></td>
                        <td><?= $producto['Proovedor_idProovedor']; ?></td>
                        <td><?= $producto['Precio']; ?></td>
                        <td><?= $producto['Stock']; ?></td>
                        <td>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#formModal" 
                                    data-id="<?= $producto['id']; ?>" 
                                    data-nombre="<?= $producto['Nombre_Productos']; ?>" 
                                    data-proveedor_id="<?= $producto['Proovedor_idProovedor']; ?>" 
                                    data-administrador_id="<?= $producto['Administrador_idAdministrador']; ?>" 
                                    data-precio="<?= $producto['Precio']; ?>" 
                                    data-cantidad="<?= $producto['Stock']; ?>">Editar</button>
                            <a href="?delete_id=<?= $producto['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este producto?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para agregar/editar producto -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Agregar/Editar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="productId">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="proveedor_id" class="form-label">ID Proveedor</label>
                            <input type="number" class="form-control" name="proveedor_id" id="proveedor_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="administrador_id" class="form-label">ID Administrador</label>
                            <input type="number" class="form-control" name="administrador_id" id="administrador_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" name="precio" id="precio" required>
                        </div>
                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" name="cantidad" id="cantidad" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const modal = new bootstrap.Modal(document.getElementById('formModal'));
        document.getElementById('formModal').addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nombre = button.getAttribute('data-nombre');
            const proveedor_id = button.getAttribute('data-proveedor_id');
            const administrador_id = button.getAttribute('data-administrador_id');
            const precio = button.getAttribute('data-precio');
            const cantidad = button.getAttribute('data-cantidad');

            const form = this.querySelector('form');
            form.querySelector('#productId').value = id || '';
            form.querySelector('#nombre').value = nombre || '';
            form.querySelector('#proveedor_id').value = proveedor_id || '';
            form.querySelector('#administrador_id').value = administrador_id || '';
            form.querySelector('#precio').value = precio || '';
            form.querySelector('#cantidad').value = cantidad || '';
        });
    </script>

</body>
</html>

<?php
// Cerrar la conexión
mysqli_close($conexion);
?>

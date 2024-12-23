<?php

?>
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
        <a class="nav-link active" aria-current="page" href="#">Administración de los clientes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./conf_reg/adm_product.php">Administración del producto</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./conf_reg/adm_report.php">Administración de reportes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../clases/perfil.php">Personalizar sesión</a>
    </li>
</ul>

<script>
    let lista_clientes = [];
    let indice_edicion;

    function obtener_clientes() {
        fetch('apiClientes.php')
            .then(response => response.json())
            .then(data => {
                lista_clientes = data;
                crearTabla(lista_clientes);
            })
            .catch(error => console.error('Error al obtener clientes:', error));
    }

    function solicitar_agregar() {
        document.getElementById('input_Nombre_cliente').value = '';
        document.getElementById('input_Apellido_paterno').value = '';
        document.getElementById('input_Apellido_materno').value = '';
        document.getElementById('input_Numero_telefonico_del_cliente').value = '';
        document.getElementById('input_Domicilio').value = '';
        $("#modal_agregar").modal("show");
    }

    function registrar() {
        const nuevo_cliente = {
            Nombre_cliente: document.getElementById('input_Nombre_cliente').value,
            Apellido_paterno: document.getElementById('input_Apellido_paterno').value,
            Apellido_materno: document.getElementById('input_Apellido_materno').value,
            Numero_telefonico_del_cliente: document.getElementById('input_Numero_telefonico_del_cliente').value,
            Domicilio: document.getElementById('input_Domicilio').value
        };

        fetch('apiClientes.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(nuevo_cliente)
        })
            .then(response => response.json())
            .then(data => {
                if (data === 1) {
                    alert('Cliente registrado con éxito');
                    $("#modal_agregar").modal("hide");
                    obtener_clientes();
                } else {
                    alert('Error al registrar cliente');
                }
            })
            .catch(error => console.error('Error al registrar cliente:', error));
    }

    function crearTabla(lista_clientes) {
        let texto_html = `
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido Paterno</th>
                    <th scope="col">Apellido Materno</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Domicilio</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>`;

        lista_clientes.forEach((cliente, index) => {
            texto_html += `
            <tr>
                <td>${cliente.idLogincliente}</td>
                <td>${cliente.Nombre_cliente}</td>
                <td>${cliente.Apellido_paterno}</td>
                <td>${cliente.Apellido_materno}</td>
                <td>${cliente.Numero_telefonico_del_cliente}</td>
                <td>${cliente.Domicilio}</td>
                <td>
                    <button class="btn btn-sm btn-info mx-2" onclick="solicitar_editar(${index})">Editar</button>
                    <button class="btn btn-sm btn-danger mx-2">Eliminar</button>
                </td>
            </tr>`;
        });

        texto_html += `
            </tbody>
        </table>`;

        document.getElementById('div_tabla').innerHTML = texto_html;
    }
</script>

<h3>Clientes</h3>
<button class="btn btn-sm btn-primary mx-2" onclick="solicitar_agregar()">Agregar</button>
<button class="btn btn-sm btn-primary mx-2" onclick="obtener_clientes()">Actualizar</button>

<div id="div_tabla"></div>

<!-- Modal Agregar -->
<div class="modal fade" id="modal_agregar" tabindex="-1" aria-labelledby="modal_agregar_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_agregar_label">Agregar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="input_Nombre_cliente" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="input_Nombre_cliente">
                </div>
                <div class="mb-3">
                    <label for="input_Apellido_paterno" class="form-label">Apellido Paterno</label>
                    <input type="text" class="form-control" id="input_Apellido_paterno">
                </div>
                <div class="mb-3">
                    <label for="input_Apellido_materno" class="form-label">Apellido Materno</label>
                    <input type="text" class="form-control" id="input_Apellido_materno">
                </div>
                <div class="mb-3">
                    <label for="input_Numero_telefonico_del_cliente" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="input_Numero_telefonico_del_cliente">
                </div>
                <div class="mb-3">
                    <label for="input_Domicilio" class="form-label">Domicilio</label>
                    <input type="text" class="form-control" id="input_Domicilio">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="registrar()">Guardar</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>

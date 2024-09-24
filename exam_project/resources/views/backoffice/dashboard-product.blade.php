<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VentasFix - Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">VentasFix</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('backoffice.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('backoffice.dashboard.client') }}">Clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('backoffice.dashboard.product') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('backoffice.dashboard.user') }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <h1 class="h3 mb-4">Productos</h1>
    <button class="btn btn-primary mb-3" id="addProductBtn">Agregar Producto</button>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción Corta</th>
            <th>Precio Venta</th>
            <th>Stock Actual</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="productTableBody">
        <!-- Data will be populated here by JavaScript -->
        </tbody>
    </table>
</div>

<!-- Modal for Add/Edit Product -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Agregar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productForm">
                    <input type="hidden" id="productId">
                    <div class="mb-3">
                        <label for="productSku" class="form-label">SKU</label>
                        <input type="text" class="form-control" id="productSku" required>
                    </div>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="productName" required>
                    </div>
                    <div class="mb-3">
                        <label for="productShortDescription" class="form-label">Descripción Corta</label>
                        <input type="text" class="form-control" id="productShortDescription" required>
                    </div>
                    <div class="mb-3">
                        <label for="productLongDescription" class="form-label">Descripción Larga</label>
                        <input type="text" class="form-control" id="productLongDescription" required>
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Imagen</label>
                        <input type="text" class="form-control" id="productImage" required>
                    </div>
                    <div class="mb-3">
                        <label for="productNetPrice" class="form-label">Precio Neto</label>
                        <input type="number" class="form-control" id="productNetPrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="productSalePrice" class="form-label">Precio Venta</label>
                        <input type="number" class="form-control" id="productSalePrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="productCurrentStock" class="form-label">Stock Actual</label>
                        <input type="number" class="form-control" id="productCurrentStock" required>
                    </div>
                    <div class="mb-3">
                        <label for="productMinStock" class="form-label">Stock Mínimo</label>
                        <input type="number" class="form-control" id="productMinStock" required>
                    </div>
                    <div class="mb-3">
                        <label for="productLowStock" class="form-label">Stock Bajo</label>
                        <input type="number" class="form-control" id="productLowStock" required>
                    </div>
                    <div class="mb-3">
                        <label for="productHighStock" class="form-label">Stock Alto</label>
                        <input type="number" class="form-control" id="productHighStock" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for View Product -->
<div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewProductModalLabel">Ver Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>SKU:</strong> <span id="viewProductSku"></span></p>
                <p><strong>Nombre:</strong> <span id="viewProductName"></span></p>
                <p><strong>Descripción Corta:</strong> <span id="viewProductShortDescription"></span></p>
                <p><strong>Descripción Larga:</strong> <span id="viewProductLongDescription"></span></p>
                <p><strong>Imagen:</strong> <span id="viewProductImage"></span></p>
                <p><strong>Precio Neto:</strong> <span id="viewProductNetPrice"></span></p>
                <p><strong>Precio Venta:</strong> <span id="viewProductSalePrice"></span></p>
                <p><strong>Stock Actual:</strong> <span id="viewProductCurrentStock"></span></p>
                <p><strong>Stock Mínimo:</strong> <span id="viewProductMinStock"></span></p>
                <p><strong>Stock Bajo:</strong> <span id="viewProductLowStock"></span></p>
                <p><strong>Stock Alto:</strong> <span id="viewProductHighStock"></span></p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        fetchProducts();

        $('#addProductBtn').click(function() {
            $('#productModalLabel').text('Agregar Producto');
            $('#productForm')[0].reset();
            $('#productId').val('');
            $('#productModal').modal('show');
        });

        $('#productForm').submit(function(e) {
            e.preventDefault();
            let id = $('#productId').val();
            let url = id ? `/api/productos/${id}` : '/api/productos';
            let method = id ? 'PUT' : 'POST';
            $.ajax({
                url: url,
                method: method,
                headers: {
                    'X-API-KEY': 'asdf1234'
                },
                data: {
                    sku: $('#productSku').val(),
                    nombre: $('#productName').val(),
                    descripcionCorta: $('#productShortDescription').val(),
                    descripcionLarga: $('#productLongDescription').val(),
                    imagen: $('#productImage').val(),
                    precioNeto: $('#productNetPrice').val(),
                    precioVenta: $('#productSalePrice').val(),
                    stockActual: $('#productCurrentStock').val(),
                    stockMinimo: $('#productMinStock').val(),
                    stockBajo: $('#productLowStock').val(),
                    stockAlto: $('#productHighStock').val()
                },
                success: function(response) {
                    $('#productModal').modal('hide');
                    fetchProducts();
                }
            });
        });

        $(document).on('click', '.editProductBtn', function() {
            let id = $(this).data('id');
            $.ajax({
                url: `/api/productos/${id}`,
                method: 'GET',
                headers: {
                    'X-API-KEY': 'asdf1234'
                },
                success: function(product) {
                    $('#productModalLabel').text('Editar Producto');
                    $('#productId').val(product.id);
                    $('#productSku').val(product.sku);
                    $('#productName').val(product.nombre);
                    $('#productShortDescription').val(product.descripcionCorta);
                    $('#productLongDescription').val(product.descripcionLarga);
                    $('#productImage').val(product.imagen);
                    $('#productNetPrice').val(product.precioNeto);
                    $('#productSalePrice').val(product.precioVenta);
                    $('#productCurrentStock').val(product.stockActual);
                    $('#productMinStock').val(product.stockMinimo);
                    $('#productLowStock').val(product.stockBajo);
                    $('#productHighStock').val(product.stockAlto);
                    $('#productModal').modal('show');
                }
            });
        });

        $(document).on('click', '.deleteProductBtn', function() {
            if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                let id = $(this).data('id');
                $.ajax({
                    url: `/api/productos/${id}`,
                    method: 'DELETE',
                    headers: {
                        'X-API-KEY': 'asdf1234'
                    },
                    success: function(response) {
                        fetchProducts();
                    }
                });
            }
        });

        $(document).on('click', '.viewProductBtn', function() {
            let id = $(this).data('id');
            $.ajax({
                url: `/api/productos/${id}`,
                method: 'GET',
                headers: {
                    'X-API-KEY': 'asdf1234'
                },
                success: function(product) {
                    $('#viewProductSku').text(product.sku);
                    $('#viewProductName').text(product.nombre);
                    $('#viewProductShortDescription').text(product.descripcionCorta);
                    $('#viewProductLongDescription').text(product.descripcionLarga);
                    $('#viewProductImage').text(product.imagen);
                    $('#viewProductNetPrice').text(product.precioNeto);
                    $('#viewProductSalePrice').text(product.precioVenta);
                    $('#viewProductCurrentStock').text(product.stockActual);
                    $('#viewProductMinStock').text(product.stockMinimo);
                    $('#viewProductLowStock').text(product.stockBajo);
                    $('#viewProductHighStock').text(product.stockAlto);
                    $('#viewProductModal').modal('show');
                }
            });
        });

        function fetchProducts() {
            $.ajax({
                url: '/api/productos',
                method: 'GET',
                headers: {
                    'X-API-KEY': 'asdf1234'
                },
                success: function(products) {
                    let rows = '';
                    products.forEach(product => {
                        rows += `
                            <tr>
                                <td>${product.id}</td>
                                <td>${product.nombre}</td>
                                <td>${product.descripcionCorta}</td>
                                <td>${product.precioVenta}</td>
                                <td>${product.stockActual}</td>
                                <td>
                                    <button class="btn btn-sm btn-info viewProductBtn" data-id="${product.id}">Ver</button>
                                    <button class="btn btn-sm btn-warning editProductBtn" data-id="${product.id}">Editar</button>
                                    <button class="btn btn-sm btn-danger deleteProductBtn" data-id="${product.id}">Eliminar</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#productTableBody').html(rows);
                }
            });
        }
    });
</script>
</body>
</html>

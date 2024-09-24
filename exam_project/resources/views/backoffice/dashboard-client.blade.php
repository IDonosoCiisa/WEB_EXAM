<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VentasFix - Clientes</title>
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
    <h1 class="h3 mb-4">Clientes</h1>
    <button class="btn btn-primary mb-3" id="addClientBtn">Agregar Cliente</button>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>RUT Empresa</th>
            <th>Rubro</th>
            <th>Razón Social</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Nombre Contacto</th>
            <th>Email Contacto</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="clientTableBody">
        <!-- Data will be populated here by JavaScript -->
        </tbody>
    </table>
</div>

<!-- Modal for Add/Edit Client -->
<div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clientModalLabel">Agregar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="clientForm">
                    <input type="hidden" id="clientId">
                    <div class="mb-3">
                        <label for="clientRutEmpresa" class="form-label">RUT Empresa</label>
                        <input type="text" class="form-control" id="clientRutEmpresa" required>
                    </div>
                    <div class="mb-3">
                        <label for="clientRubro" class="form-label">Rubro</label>
                        <input type="text" class="form-control" id="clientRubro" required>
                    </div>
                    <div class="mb-3">
                        <label for="clientRazonSocial" class="form-label">Razón Social</label>
                        <input type="text" class="form-control" id="clientRazonSocial" required>
                    </div>
                    <div class="mb-3">
                        <label for="clientTelefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="clientTelefono" required>
                    </div>
                    <div class="mb-3">
                        <label for="clientDireccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="clientDireccion" required>
                    </div>
                    <div class="mb-3">
                        <label for="clientNombreContacto" class="form-label">Nombre Contacto</label>
                        <input type="text" class="form-control" id="clientNombreContacto" required>
                    </div>
                    <div class="mb-3">
                        <label for="clientEmailContacto" class="form-label">Email Contacto</label>
                        <input type="email" class="form-control" id="clientEmailContacto" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        fetchClients();

        $('#addClientBtn').click(function() {
            $('#clientModalLabel').text('Agregar Cliente');
            $('#clientForm')[0].reset();
            $('#clientId').val('');
            $('#clientModal').modal('show');
        });

        $('#clientForm').submit(function(e) {
            e.preventDefault();
            let id = $('#clientId').val();
            let url = id ? `/api/clientes/${id}` : '/api/clientes';
            let method = id ? 'PUT' : 'POST';
            $.ajax({
                url: url,
                method: method,
                headers: {
                    'X-API-KEY': 'asdf1234'
                },
                data: {
                    rutEmpresa: $('#clientRutEmpresa').val(),
                    rubro: $('#clientRubro').val(),
                    razonSocial: $('#clientRazonSocial').val(),
                    telefono: $('#clientTelefono').val(),
                    direccion: $('#clientDireccion').val(),
                    nombreContacto: $('#clientNombreContacto').val(),
                    emailContacto: $('#clientEmailContacto').val()
                },
                success: function(response) {
                    $('#clientModal').modal('hide');
                    fetchClients();
                }
            });
        });

        $(document).on('click', '.editClientBtn', function() {
            let id = $(this).data('id');
            $.ajax({
                url: `/api/clientes/${id}`,
                method: 'GET',
                headers: {
                    'X-API-KEY': 'asdf1234'
                },
                success: function(client) {
                    $('#clientModalLabel').text('Editar Cliente');
                    $('#clientId').val(client.id);
                    $('#clientRutEmpresa').val(client.rutEmpresa);
                    $('#clientRubro').val(client.rubro);
                    $('#clientRazonSocial').val(client.razonSocial);
                    $('#clientTelefono').val(client.telefono);
                    $('#clientDireccion').val(client.direccion);
                    $('#clientNombreContacto').val(client.nombreContacto);
                    $('#clientEmailContacto').val(client.emailContacto);
                    $('#clientModal').modal('show');
                }
            });
        });

        $(document).on('click', '.deleteClientBtn', function() {
            if (confirm('¿Estás seguro de que deseas eliminar este cliente?')) {
                let id = $(this).data('id');
                $.ajax({
                    url: `/api/clientes/${id}`,
                    method: 'DELETE',
                    headers: {
                        'X-API-KEY': 'asdf1234'
                    },
                    success: function(response) {
                        fetchClients();
                    }
                });
            }
        });

        function fetchClients() {
            $.ajax({
                url: '/api/clientes',
                method: 'GET',
                headers: {
                    'X-API-KEY': 'asdf1234'
                },
                success: function(clients) {
                    let rows = '';
                    clients.forEach(client => {
                        rows += `
                            <tr>
                                <td>${client.id}</td>
                                <td>${client.rutEmpresa}</td>
                                <td>${client.rubro}</td>
                                <td>${client.razonSocial}</td>
                                <td>${client.telefono}</td>
                                <td>${client.direccion}</td>
                                <td>${client.nombreContacto}</td>
                                <td>${client.emailContacto}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning editClientBtn" data-id="${client.id}">Editar</button>
                                    <button class="btn btn-sm btn-danger deleteClientBtn" data-id="${client.id}">Eliminar</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#clientTableBody').html(rows);
                }
            });
        }
    });
</script>
</body>
</html>

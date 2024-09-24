<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VentasFix - Usuarios</title>
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
    <h1 class="h3 mb-4">Usuarios</h1>
    <button class="btn btn-primary mb-3" id="addUserBtn">Agregar Usuario</button>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>RUT</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="userTableBody">
        <!-- Data will be populated here by JavaScript -->
        </tbody>
    </table>
</div>

<!-- Modal for Add/Edit User -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Agregar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <input type="hidden" id="userId">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="userName" required>
                    </div>
                    <div class="mb-3">
                        <label for="userLastName" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="userLastName" required>
                    </div>
                    <div class="mb-3">
                        <label for="userRut" class="form-label">RUT</label>
                        <input type="text" class="form-control" id="userRut" required>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email</label>
                        <input type="text" class="form-control" id="userEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="userPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="userPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for View User -->
<div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewUserModalLabel">Ver Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nombre:</strong> <span id="viewUserName"></span></p>
                <p><strong>Apellido:</strong> <span id="viewUserLastName"></span></p>
                <p><strong>RUT:</strong> <span id="viewUserRut"></span></p>
                <p><strong>Email:</strong> <span id="viewUserEmail"></span></p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        fetchUsers();

        $('#addUserBtn').click(function() {
            $('#userModalLabel').text('Agregar Usuario');
            $('#userForm')[0].reset();
            $('#userId').val('');
            $('#userModal').modal('show');
        });

        $('#userForm').submit(function(e) {
            e.preventDefault();
            let id = $('#userId').val();
            let url = id ? `/api/usuarios/${id}` : '/api/usuarios';
            let method = id ? 'PUT' : 'POST';
            $.ajax({
                url: url,
                method: method,
                headers: {
                    'X-API-KEY': 'asdf1234'
                },
                data: {
                    nombre: $('#userName').val(),
                    apellido: $('#userLastName').val(),
                    rut: $('#userRut').val(),
                    email: $('#userEmail').val(),
                    password: $('#userPassword').val()
                },
                success: function(response) {
                    $('#userModal').modal('hide');
                    fetchUsers();
                }
            });
        });

        $(document).on('click', '.editUserBtn', function() {
            let id = $(this).data('id');
            $.ajax({
                url: `/api/usuarios/${id}`,
                method: 'GET',
                headers: {
                    'X-API-KEY': 'asdf1234'
                },
                success: function(user) {
                    $('#userModalLabel').text('Editar Usuario');
                    $('#userId').val(user.id);
                    $('#userName').val(user.nombre);
                    $('#userLastName').val(user.apellido);
                    $('#userRut').val(user.rut);
                    $('#userEmail').val(user.email);
                    $('#userModal').modal('show');
                }
            });
        });

        $(document).on('click', '.deleteUserBtn', function() {
            if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                let id = $(this).data('id');
                $.ajax({
                    url: `/api/usuarios/${id}`,
                    method: 'DELETE',
                    headers: {
                        'X-API-KEY': 'asdf1234'
                    },
                    success: function(response) {
                        fetchUsers();
                    }
                });
            }
        });

        $(document).on('click', '.viewUserBtn', function() {
            let id = $(this).data('id');
            $.ajax({
                url: `/api/usuarios/${id}`,
                method: 'GET',
                headers: {
                    'X-API-KEY': 'asdf1234'
                },
                success: function(user) {
                    $('#viewUserName').text(user.nombre);
                    $('#viewUserLastName').text(user.apellido);
                    $('#viewUserRut').text(user.rut);
                    $('#viewUserEmail').text(user.email);
                    $('#viewUserModal').modal('show');
                }
            });
        });

        function fetchUsers() {
            $.ajax({
                url: '/api/usuarios',
                method: 'GET',
                headers: {
                    'X-API-KEY': 'asdf1234'
                },
                success: function(users) {
                    let rows = '';
                    users.forEach(user => {
                        rows += `
                            <tr>
                                <td>${user.id}</td>
                                <td>${user.nombre}</td>
                                <td>${user.apellido}</td>
                                <td>${user.rut}</td>
                                <td>${user.email}</td>
                                <td>
                                    <button class="btn btn-sm btn-info viewUserBtn" data-id="${user.id}">Ver</button>
                                    <button class="btn btn-sm btn-warning editUserBtn" data-id="${user.id}">Editar</button>
                                    <button class="btn btn-sm btn-danger deleteUserBtn" data-id="${user.id}">Eliminar</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#userTableBody').html(rows);
                }
            });
        }
    });
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Accounts List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .main-content {
            flex: 1;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .action-btns {
            white-space: nowrap;
        }

        .card-header {
            background-color: #343a40;
            color: white;
        }

        footer {
            flex-shrink: 0;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('create.user.form') }}">Create User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('user.accounts.list') }}">User Accounts</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" id="logout-form" class="d-inline">
                            @csrf
                            <a href="#" class="nav-link"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div class="container py-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">User Accounts List</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Account Type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $user->username === 'admin' ? 'bg-danger' : 'bg-primary' }}">
                                                {{ $user->username === 'admin' ? 'Administrator' : 'Standard User' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge {{ $user->defaultpassword ? 'bg-warning text-dark' : 'bg-success' }}">
                                                {{ $user->defaultpassword ? 'Needs Password Update' : 'Active' }}
                                            </span>
                                        </td>
                                        <td class="action-btns">
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning"
                                                title="Edit Username">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            </a>
                                            <form action="{{ route('user.delete', $user->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p class="mb-0">Admin Dashboard &copy; {{ date('Y') }}</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Prevent page caching
        window.onpageshow = function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        };

    </script>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</body>

</html>
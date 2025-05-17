<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .dashboard-card {
            transition: all 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .password-form {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        .input-icon {
            position: absolute;
            z-index: 2;
            display: block;
            width: 38px;
            height: 38px;
            line-height: 38px;
            text-align: center;
            pointer-events: none;
            color: #b7b9cc;
            margin-top: 5px;
            margin-left: 5px;
        }

        .form-control {
            padding-left: 45px;
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
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#updatePasswordModal">
                            Update Password
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline" id="logoutForm">
                            @csrf
                            <button type="button" class="nav-link btn btn-link"
                                style="border:none;background:none;cursor:pointer;" onclick="confirmLogout()">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card dashboard-card text-white bg-primary h-100">
                    <div class="card-body">
                        <h5 class="card-title">User Management</h5>
                        <p class="card-text">Create and manage system users</p>
                        <a href="{{ route('create.user.form') }}" class="btn btn-light">Go to Users</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card dashboard-card text-white bg-success h-100">
                    <div class="card-body">
                        <h5 class="card-title">System Settings</h5>
                        <p class="card-text">Configure application settings</p>
                        <a href="#" class="btn btn-light">Go to Settings</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card dashboard-card text-white bg-info h-100">
                    <div class="card-body">
                        <h5 class="card-title">Reports</h5>
                        <p class="card-text">View system reports and analytics</p>
                        <a href="#" class="btn btn-light">View Reports</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Welcome, Admin!</h4>
            </div>
            <div class="card-body">
                <p>You have successfully logged in to the administration panel.</p>
                <div class="alert alert-info">
                    <strong>Quick Actions:</strong>
                    <ul class="mt-2">
                        <li><a href="{{ route('create.user.form') }}" class="alert-link">Create a new user</a></li>
                        <li><a href="{{ route('user.accounts.list') }}" class="alert-link">View User Accounts list</a>
                        </li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#updatePasswordModal"
                                class="alert-link">Update Password</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updatePasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-key me-2"></i>Update Password</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('update.password.form') }}" id="updatePasswordForm">
                    @csrf
                    <div class="modal-body">
                        <!-- Current Password Field -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password"
                                required autocomplete="off">
                        </div>

                        <!-- New Password Field -->
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required
                                minlength="8" autocomplete="off">
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="new_password_confirmation" required autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
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

        // Logout confirmation function
        function confirmLogout() {
            if (confirm('Are you sure you want to logout?')) {
                document.getElementById('logoutForm').submit();
            }
        }
    </script>
</body>

</html>
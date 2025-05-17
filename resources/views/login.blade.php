<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <style>
        body {
            background: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-container {
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-container">
            @if(session('logout_message'))
                <div class="alert alert-info mb-4">
                    {{ session('logout_message') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <h2 class="text-center mb-4">Login</h2>

                @if($errors->any())
                    <div class="alert alert-danger mb-4">
                        Invalid credentials. Please try again.
                    </div>
                @endif

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" autocomplete="off" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="off"
                        required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Clear any cached form data
            document.getElementById('loginForm').reset();

            // Ensure CSRF token is fresh
            fetch('/sanctum/csrf-cookie').then(() => {
                console.log('CSRF cookie refreshed');
            });

            // Extra protection against back button
            window.onpageshow = function (event) {
                if (event.persisted) {
                    window.location.reload();
                }
            };
        });
    </script>
</body>

</html>


<!-- <!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
</head>

<body>
    <div class="login-container">
        @if(session('logout_message'))
            <div class="alert alert-info">
                {{ session('logout_message') }}
            </div>
        @endif
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Login</div>
                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username: </label>
                                    <input type="text" name="username" autocomplete="off" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password: </label>
                                    <input type="password" name="password" autocomplete="off" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Clear form fields and prevent autofill
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.querySelector('form');
                form.reset();
                document.querySelectorAll('input').forEach(input => {
                    input.value = '';
                    input.autocomplete = 'off';
                });

                // Extra protection against back button
                if (performance.navigation.type == 2) {
                    window.location.reload(true);
                }
            });
        </script>
</body>

</html> -->
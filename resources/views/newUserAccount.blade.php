<!DOCTYPE html>
<html>

<head>
    <title>Create New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Create New User</div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form method="POST" action="{{ route('create.user') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Create User</button>
                            <a href="{{ route('administrator.dashboard') }}" class="btn btn-secondary">Back to
                                Dashboard</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Prevent back-button cache
        window.onpageshow = function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        };

        // Clear form cache
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('form').forEach(form => {
                form.reset();
            });
        });
    </script>
</body>

</html>
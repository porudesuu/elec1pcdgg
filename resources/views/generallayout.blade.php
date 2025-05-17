<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f9f9f9;
        }

        .header {
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .header nav a {
            color: white;
            text-decoration: none;
            margin: 0 0.75rem;
            font-size: 1rem;
        }

        .header nav a:hover {
            text-decoration: underline;
        }

        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 3px;
            bottom: 0;
            width: 100%;
        }

        .footer a {
            color: #6a11cb;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        main {
            padding: 2rem;
            min-height: 80vh;
        }

        /* Confirmation Modal Styles */
        .confirmation-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 1.5rem;
            gap: 1rem;
        }

        .modal-actions button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .confirm-btn {
            background-color: #dc3545;
            color: white;
        }

        .cancel-btn {
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>

<body>
    @section('header')
    <div class="header">
        <div class="logo">Porurut Project</div>
        <nav>
            <a href="/employee/dashboard">Dashboard</a>
            <a href="/employee/aboutus">About</a>
            <a href="/employee/contacts">Contact Us</a>
            <a href="/employee/cs">Control Structure</a>
            <a href="/employee">Employee List</a>
            <a href="/log">Logs</a>
            <a href="{{ route('update.password.form') }}">Update Password</a>
            <a href="#" onclick="showLogoutConfirmation(event)">Logout</a>
        </nav>
    </div>
    @show

    <!-- Logout Confirmation Modal -->
    <div id="logoutConfirmation" class="confirmation-modal">
        <div class="modal-content">
            <h3>Confirm Logout</h3>
            <p>Are you sure you want to logout?</p>
            <div class="modal-actions">
                <button class="cancel-btn" onclick="hideLogoutConfirmation()">Cancel</button>
                <button class="confirm-btn" onclick="confirmLogout()">Logout</button>
            </div>
        </div>
    </div>

    <main>
        @yield('contents')
    </main>

    @section('footer')
    <div class="footer">
        <p>&copy; 2025 Paul Cyber. All Rights Reserved. | <a href="#">Privacy Policy</a></p>
    </div>
    @show

    <!-- Hidden Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        // Prevent page caching
        window.onpageshow = function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        };

        // Logout Confirmation Functions
        function showLogoutConfirmation(e) {
            e.preventDefault();
            document.getElementById('logoutConfirmation').style.display = 'flex';
        }

        function hideLogoutConfirmation() {
            document.getElementById('logoutConfirmation').style.display = 'none';
        }

        function confirmLogout() {
            document.getElementById('logout-form').submit();
        }
    </script>

</body>

</html>
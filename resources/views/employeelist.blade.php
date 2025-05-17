@extends('generallayout')

@section('title', 'Employee')

@section('contents')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        table {
            width: 100%;
            margin: 10px auto;
            border-collapse: collapse;
            font-size: 16px;
            text-align: left;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            background-color: rgb(54, 125, 249);
            color: white;
            padding: 12px;
            text-transform: uppercase;
            text-align: center;
        }

        td {
            padding: 12px;
            border: 1px solid #ddd;
            color: #333;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
            transition: 0.3s;
        }

        .action-btn {
            display: inline-block;
            padding: 6px 12px;
            margin: 0 2px;
            font-size: 14px;
            text-decoration: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
        }

        .edit-btn {
            background-color: #28a745;
            border: none;
        }

        .delete-btn {
            background-color: #dc3545;
            border: none;
        }

        .edit-btn:hover {
            background-color: #218838;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .action-container {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        /* Aligning the 'new' button */
        .new-button-container {
            display: flex;
            justify-content: flex-end;
            margin: 20px 0;
        }

        .new-button-container a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .new-button-container a:hover {
            background-color: #0056b3;
        }

        .show-btn {
            background-color: blueviolet;
            border: 0;
        }

        /* Pagination styles */
        .pagination {
            justify-content: center;
            margin: 20px 0;
        }

        .pagination .page-item .page-link {
            color: #007bff;
            border: 1px solid #007bff;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            color: white;
            border: 1px solid #007bff;
        }

        .pagination {
            display: flex;
            justify-content: left;
            align-items: center;
            margin: 20px auto;
            padding: 10px 0;
            list-style: none;
        }

        /* Pagination Items */
        .pagination .page-item {
            margin: 0 5px;
        }

        /* Pagination Links */
        .pagination .page-link {
            display: inline-block;
            padding: 8px 12px;
            font-size: 14px;
            text-decoration: none;
            color: #007bff;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Active Page Styling */
        .pagination .page-item.active .page-link {
            background-color: #007bff;
            color: white;
            border: 1px solid #007bff;
            font-weight: bold;
        }

        /* Hover Effects */
        .pagination .page-link:hover {
            background-color: #0056b3;
            color: white;
            border: 1px solid #0056b3;
        }

        /* Disabled State Styling */
        .pagination .page-item.disabled .page-link {
            background-color: #f8f9fa;
            color: #6c757d;
            border: 1px solid #ddd;
            cursor: not-allowed;
        }

        .alert {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            font-size: 14px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .alert {
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
    </style>

    <div class="new-button-container">
        <a href="/employee/create" class="button">New</a>
    </div>


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif


    <table border="1">
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Contact Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($emp as $employee)
                <tr>
                    <td>{{ $employee['employeeID'] }}</td>
                    <td>{{ $employee['firstname'] }}</td>
                    <td>{{ $employee['middlename'] }}</td>
                    <td>{{ $employee['lastname'] }}</td>
                    <td>{{ $employee['address'] }}</td>
                    <td>{{ $employee['contact_no'] }}</td>
                    <td>
                        <div class="action-container">
                            <a href="employee/{{ $employee->id }}/edit"><button class="action-btn edit-btn">Edit</button></a>
                            <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete-btn"
                                    onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                            </form>
                            <a href="employee/{{ $employee->id }}"><button class="action-btn show-btn">View</button></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            const inputs = form.querySelectorAll('input, textarea');

            let hasChanges = false;
            const originalValues = {};

            // Store original values for all inputs
            inputs.forEach(input => {
                originalValues[input.name] = input.value;

                // Track changes
                input.addEventListener('input', function () {
                    if (input.value !== originalValues[input.name]) {
                        hasChanges = true;
                    }
                });

                // Restore value if field is cleared
                input.addEventListener('blur', function () {
                    if (input.value.trim() === '') {
                        input.value = originalValues[input.name];
                    }
                });
            });
        });
    </script>


    <!-- Pagination -->
    <nav>
        <ul class="pagination">
            {{ $emp->links() }}
        </ul>
    </nav>

@endsection
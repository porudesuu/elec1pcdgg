@extends('generallayout')

@section('title', 'Employee')

@section('head')
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        .employee-details {
            margin: 30px auto;
            max-width: 600px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .employee-details h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }

        .employee-details p {
            font-size: 16px;
            line-height: 1.5;
            color: #495057;
        }

        .employee-details .label {
            font-weight: bold;
        }

        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: block;
        }
    </style>
@endsection

@section('contents')
    <div class="container">
        <div class="employee-details">
            <h2>Employee Details</h2>
            <p><span class="label">Employee ID:</span> {{ $emp->employeeID }}</p>
            <p><span class="label">Name:</span> {{ $emp->firstname }} {{ $emp->middlename }} {{ $emp->lastname }}</p>
            <p><span class="label">Address:</span> {{ $emp->address }}</p>
            <p><span class="label">Contact Number:</span> {{ $emp->contact_no }}</p>
            <a href="{{ route('employeelist') }}" class="btn btn-primary">Back to Employee List</a>
        </div>
    </div>
@endsection
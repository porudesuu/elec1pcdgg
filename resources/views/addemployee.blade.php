@extends('generallayout')

@section('title', 'New Employee')

@section('contents')

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        /* General Form Styling */
        .form-container {
            max-width: 600px;
            margin: 30px auto;
            padding: 50px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: rgb(54, 125, 249);
            box-shadow: 0px 0px 5px rgba(54, 125, 249, 0.5);
        }

        .form-actions {
            text-align: center;
        }

        .form-actions button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
        }

        .form-actions .submit-btn {
            background-color: #28a745;
        }

        .form-actions .submit-btn:hover {
            background-color: #218838;
        }
    </style>

    <div class="form-container">

        <h2>New Employee Form</h2>
        <form action="/employee" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="employeeID">Employee ID:</label>
                <input type="text" id="employeeID" name="employeeID" value="E-{{ date('y') }}-{{ $totalEmp + 1 }}" required
                    readonly>
            </div>
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" required>
            </div>
            <div class="form-group">
                <label for="middlename">Middle Name:</label>
                <input type="text" id="middlename" name="middlename">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="contact_no">Contact Number:</label>
                <input type="text" id="contact_no" name="contact_no" required>
            </div>
            <div class="form-group">
                <label for="employee_picture">Employee Picture:</label>
                <input type="file" id="employee_picture" name="employee_picture" accept="image/*">
            </div>
            <div class="form-actions">
                <button type="submit" class="submit-btn">Submit</button>
            </div>
        </form>
    </div>

@endsection
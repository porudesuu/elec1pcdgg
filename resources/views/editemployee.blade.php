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

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif



    <div class="form-container">

        <h2>New Employee Form</h2>
        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Use PUT or PATCH for updating -->

            <div class="form-group">
                <label for="employeeID">Employee ID:</label>
                <input type="text" id="employeeID" name="employeeID" value="{{ old('employeeID', $employee->employeeID) }}"
                    readonly>
            </div>
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" value="{{ old('firstname') ?? $employee->firstname }}">
            </div>
            <div class="form-group">
                <label for="middlename">Middle Name:</label>
                <input type="text" id="middlename" name="middlename"
                    value="{{ old('middlename') ?? $employee->middlename }}">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" value="{{ old('lastname') ?? $employee->lastname }}">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="3" required>{{ old('address', $employee->address) }}</textarea>
            </div>
            <div class="form-group">
                <label for="contact_no">Contact Number:</label>
                <input type="text" id="contact_no" name="contact_no" value="{{ old('contact_no', $employee->contact_no) }}"
                    required>
            </div>
            <div class="form-actions">
                <button type="submit" class="submit-btn">Update</button>
            </div>
        </form>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.querySelector("form");
            const inputs = form.querySelectorAll("input:not([readonly]), textarea:not([readonly])");

            // Store initial values of inputs
            const originalValues = {};
            inputs.forEach(input => {
                originalValues[input.id] = input.value.trim();
            });

            inputs.forEach(input => {
                input.addEventListener("blur", function () {
                    const value = input.value.trim();
                    const errorDiv = document.getElementById(input.id + "-error") || createErrorDiv(input);

                    if (value.length < 3) {
                        errorDiv.textContent = "This field should have at least 3 characters.";
                        errorDiv.style.display = "block";
                        input.classList.add("is-invalid");
                    } else {
                        errorDiv.style.display = "none";
                        input.classList.remove("is-invalid");
                    }
                });
            });

            form.addEventListener("submit", function (event) {
                let isValid = true;
                let hasChanges = false;

                inputs.forEach(input => {
                    const value = input.value.trim();
                    const errorDiv = document.getElementById(input.id + "-error") || createErrorDiv(input);

                    if (value.length < 3) {
                        errorDiv.textContent = "This field should have at least 3 characters.";
                        errorDiv.style.display = "block";
                        input.classList.add("is-invalid");
                        isValid = false;
                    } else {
                        errorDiv.style.display = "none";
                        input.classList.remove("is-invalid");
                        if (value !== originalValues[input.id]) {
                            hasChanges = true;
                        }
                    }
                });

                // if (!isValid) {
                //     event.preventDefault();
                //     alert("Please fix the errors before submitting the form.");
                // } else 
                if (!hasChanges) {
                    event.preventDefault();
                    alert("No changes detected.");
                }
            });

            function createErrorDiv(input) {
                const errorDiv = document.createElement("div");
                errorDiv.id = input.id + "-error";
                errorDiv.classList.add("invalid-feedback");
                input.parentNode.appendChild(errorDiv);
                return errorDiv;
            }
        });
    </script>
@endsection
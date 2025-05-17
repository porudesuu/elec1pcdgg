@extends('GeneralLayout')

@section('title', 'Employee')
@section('contents')
    <div style="text-align: center; margin-top: 50px;">
        <h1>Grade Calculation</h1>
        @php
            $grade = ''; 
        @endphp

        @if ($score >= 76 && $score <= 79)
            @php $grade = '2.75'; @endphp
        @elseif ($score >= 79 && $score <= 81)
            @php $grade = '2.50'; @endphp
        @elseif ($score >= 85 && $score <= 87)
            @php $grade = '2.00'; @endphp
        @elseif ($score >= 88 && $score <= 90)
            @php $grade = '1.75'; @endphp
        @elseif ($score >= 91 && $score <= 93)
            @php $grade = '1.50'; @endphp
        @elseif ($score >= 94 && $score <= 96)
            @php $grade = '1.25'; @endphp
        @elseif ($score >= 97 && $score <= 100)
            @php $grade = '1.00'; @endphp
        @elseif ($score = 0)
            @php $grade = 'Invalid Number!'; @endphp
        @elseif ($score >= -1 && $score <= 101)
            @php $grade = 'Invalid Number!'; @endphp
        @else
            @php $grade = 'Failed'; @endphp
        @endif

        <h2>Your grade is: <span style="color: #007BFF;">{{ $grade }}</span></h2>

        <h1 style="margin-top: 50px;">Employee List</h1>
        <table border="1" style="width: 50%; margin: 20px auto; text-align: center;">
            <tr style="border: solid;">
                <th>Name</th>
                <th>Age</th>
                <th>Department</th>
            </tr>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee['name'] }}</td>
                    <td>{{ $employee['age'] }}</td>
                    <td>{{ $employee['Job'] }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div style="margin-left: 800px; padding-bottom: 50px;">
        @php
            $number = 10;
        @endphp
        @for ($i = 0; $i <= $number; $i++)

            @for ($j = 0; $j <= $i; $j++)
                @if ($i == $number)
                    *
                @elseif ($i == $j || $j == 0)
                    *
                @else
                    -
                @endif
            @endfor
            <br>

        @endfor
    </div>
@endsection
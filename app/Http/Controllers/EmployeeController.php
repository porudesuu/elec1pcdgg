<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function greet($name = "Student")
    {
        return "Hello " . $name . " Kamusta Capstone perds?? Kaya paba natin ipropose yan? :))";
    }
}

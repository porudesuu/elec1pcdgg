<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class studentController extends Controller
{
    public function reqs($name)
    {
        return "Kamusta ka? " . $name;
    }

    public function ops($name = "Student")
    {
        return "Kamusta ka? " . $name;
    }
}

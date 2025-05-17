<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function contacts()
    {
        return view('contactuspage');
    }

    public function aboutus()
    {
        return view('aboutuspage');
    }

    public function info()
    {
        return view('grades');
    }


}

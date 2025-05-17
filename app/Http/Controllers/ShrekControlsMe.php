<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShrekControlsMe extends Controller
{


    public function index()
    {
        return "named route indirect maderpader";
    }


    /**
     * Redirect using a URI.
     */
    public function redirectToURI()
    {
        return redirect('/aboutus')->with('info', 'Redirected using URI!');
    }



    /**
     * Redirect using a controller action.
     */

    public function redirectToController()
    {
        return redirect()->action([EmployeeController::class, 'targetMethod'])->with('warning', 'Redirected using controller action!');
    }
}

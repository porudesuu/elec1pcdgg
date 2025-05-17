<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControlStructureController extends Controller
{
    public function info($score = "sherk")
    {
        $employees = [
            ["name" => "Paul Cyber D. Gino-Gino", "age" => "20", "Job" => "IT"],
            ["name" => "Jenny Ann S. Domingo", "age" => "21", "Job" => "Pharmacist"],
            ["name" => "Jan Tyron R. Gundayao", "age" => "20", "Job" => "Programmer"],
            ["name" => "Jommel C. Incipido", "age" => "69", "Job" => "Web-Developer"],
            ["name" => "Joshua C. Daroya", "age" => "20", "Job" => "Full-Stacked Developer"],
            ["name" => "Julius Zyrell D. Tibagkol", "age" => "23", "Job" => "Software Developer"],
            ["name" => "Rhonjoval L. Caldona", "age" => "420", "Job" => "Aspok Developer"],
            ["name" => "Lord Hendrix Lucanus M. Camero", "age" => "12", "Job" => "Full-Stacked Predator"],
            ["name" => "Clarence R. Lopez", "age" => "30", "Job" => "Amba Slayer"],
            ["name" => "Sheryl Q. Aquino", "age" => "14", "Job" => "Wetty Programmer"]
        ];
        return view('grades', compact('score', 'employees'));
    }
}

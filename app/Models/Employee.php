<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // Specify the fields that can be mass-assigned
    protected $fillable = [
        'employeeID',
        'firstname',
        'middlename',
        'lastname',
        'address',
        'contact_no',
        'image_path'
    ];
}

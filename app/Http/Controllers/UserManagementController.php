<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserManagementController extends Controller
{
    public function createForm()
    {
        if (!Session::get('can_access_admin')) {
            return redirect()->route('login.form')->with('error', 'Unauthorized access');
        }

        return view('admin.create_user');
    }

    public function store(Request $request)
    {
        if (!Session::get('can_access_admin')) {
            return redirect()->route('login.form')->with('error', 'Unauthorized access');
        }

        $request->validate([
            'username' => 'required|unique:user_accounts,username',
            'role' => 'required|in:admin,manager,employee',
            'can_access_admin' => 'sometimes|boolean'
        ]);

        UserAccount::create([
            'username' => $request->username,
            'password' => Hash::make('password123'),
            'defaultpassword' => true,
            'role' => $request->role,
            'can_access_admin' => $request->has('can_access_admin')
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User created successfully');
    }
}
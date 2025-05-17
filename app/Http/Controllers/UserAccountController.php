<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserAccountController extends Controller
{
    // Admin functions
    public function showCreateUserForm()
    {
        return view('newUserAccount');
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:user_accounts,username'
        ]);

        UserAccount::createWithDefaultPassword($request->username);

        return redirect()->route('administrator.dashboard')->with('success', 'User created successfully with default password');
    }

    // Authentication functions
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = UserAccount::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid credentials');
        }

        // Set session variables
        Session::put([
            'user' => $user->username,
            'is_admin' => $user->username === 'admin',
            'user_id' => $user->id,
            'needs_password_update' => $user->defaultpassword,
            'last_activity' => time()
        ]);

        // Handle password update flow
        if ($user->defaultpassword) {
            return redirect()->route('update.password.form');
        }

        // Redirect based on role
        return redirect()->intended(
            $user->username === 'admin'
            ? route('administrator.dashboard')
            : route('employee.dashboard')
        );
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'username' => 'required',
    //         'password' => 'required'
    //     ]);

    //     $user = UserAccount::where('username', $request->username)->first();

    //     if (!$user || !Hash::check($request->password, $user->password)) {
    //         return back()->with('error', 'Invalid credentials');
    //     }

    //     // Set session variables
    //     Session::put([
    //         'user' => $user->username,
    //         'is_admin' => $user->username === 'admin',
    //         'user_id' => $user->id,
    //         'needs_password_update' => $user->defaultpassword
    //     ]);

    //     // Handle password update flow
    //     if ($user->defaultpassword) {
    //         return redirect()->route('update.password.form');
    //     }

    //     // Redirect based on role
    //     return redirect()->intended(
    //         $user->username === 'admin'
    //         ? route('administrator.dashboard')
    //         : route('employee.dashboard')
    //     );
    // }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'username' => 'required',
    //         'password' => 'required'
    //     ]);

    //     $user = UserAccount::where('username', $request->username)->first();

    //     if (!$user || !$user->checkPassword($request->password)) {
    //         return back()->with('error', 'Invalid credentials');
    //     }

    //     // Store user in session
    //     Session::put('user', $user->username);
    //     Session::put('is_admin', $user->username === 'admin');
    //     Session::put('user_id', $user->id); // Store user ID for easy access

    //     if ($user->defaultpassword && $user->username !== 'admin') {
    //         return redirect()->route('update.password.form');
    //     }

    //     // Improved redirection logic
    //     if ($user->username === 'admin') {
    //         return redirect()->route('administrator.dashboard'); // Note the route name change
    //     }

    //     return redirect()->route('employee.dashboard');
    // }

    public function showUpdatePasswordForm()
    {
        return view('updatePassword');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required'
        ]);

        $user = UserAccount::findOrFail(Session::get('user_id'));

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect');
        }

        $user->update([
            'password' => Hash::make($request->new_password),
            'defaultpassword' => false
        ]);

        // Special handling for admin
        if ($user->username === 'admin') {
            // Refresh session to maintain admin access
            Session::put('needs_password_update', false);
            return redirect()->route('administrator.dashboard')
                ->with('success', 'Admin password updated successfully');
        }

        // For regular users - require reauthentication
        Session::flush();
        return redirect()->route('login.form')
            ->with('success', 'Password updated. Please login with your new credentials');
    }


    public function logout()
    {
        // Clear all session data
        Session::flush();

        // Regenerate session ID for security
        Session::regenerate();

        // Redirect with no-cache headers
        return redirect()->route('login.form')
            ->withHeaders([
                'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
                'Pragma' => 'no-cache',
                'Expires' => 'Fri, 01 Jan 1990 00:00:00 GMT'
            ])
            ->with('logout_message', 'You have been logged out successfully.');
    }

    // public function logout()
    // {
    //     // Clear all session data
    //     Session::flush();

    //     // Regenerate session ID for security
    //     Session::regenerate();

    //     // Redirect with no-cache headers
    //     return redirect()->route('login.form')
    //         ->withHeaders([
    //             'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
    //             'Pragma' => 'no-cache',
    //             'Expires' => 'Fri, 01 Jan 1990 00:00:00 GMT'
    //         ]);
    // }
    public function showUserAccountsList()
    {
        $users = UserAccount::where('username', '!=', 'admin')->get();
        return view('admin.userAccountsList', compact('users'));
    }

    public function showEditUserForm($id)
    {
        $user = UserAccount::findOrFail($id);
        return view('admin.editUser', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|unique:user_accounts,username,' . $id
        ]);

        $user = UserAccount::findOrFail($id);
        $user->username = $request->username;
        $user->save();

        return redirect()->route('user.accounts.list')
            ->with('success', 'Username updated successfully');
    }

    public function deleteUser($id)
    {
        // Prevent admin user from being deleted
        if ($id == 1) { // Assuming admin has ID 1
            return redirect()->route('user.accounts.list')
                ->with('error', 'Admin user cannot be deleted');
        }

        $user = UserAccount::findOrFail($id);
        $user->delete();

        return redirect()->route('user.accounts.list')
            ->with('success', 'User deleted successfully');
    }
}
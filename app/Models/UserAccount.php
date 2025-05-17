<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserAccount extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'password', 'defaultpassword', 'role', 'can_access_admin'];

    public function canAccessAdmin()
    {
        return $this->can_access_admin || $this->role === 'admin';
    }

    public static function createWithDefaultPassword($username)
    {
        return self::create([
            'username' => $username,
            'password' => Hash::make('password123'),
            'defaultpassword' => true
        ]);
    }

    public function updatePassword($newPassword)
    {
        $this->password = Hash::make($newPassword);
        $this->defaultpassword = false;
        $this->save();
    }

    public function checkPassword($password)
    {
        return Hash::check($password, $this->password);
    }
}
<?php

namespace Database\Seeders;

use App\Models\UserAccount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Check if admin already exists
        if (!UserAccount::where('username', 'admin')->exists()) {
            UserAccount::create([
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'defaultpassword' => false
            ]);
            $this->command->info('Admin account created successfully!');
        } else {
            $this->command->info('Admin account already exists.');
        }
    }
}
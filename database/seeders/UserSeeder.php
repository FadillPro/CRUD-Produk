<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Pastikan model User diimpor

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  Akun Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@uas.com', 
            'password' => Hash::make('adminOkk'), 
            'role' => 'admin', 
        ]);

        //  Akun Staff
        User::create([
            'name' => 'Staff User',
            'email' => 'staff@uas.com', 
            'password' => Hash::make('staffOkk'), 
            'role' => 'staff', 
        ]);
        
    }
}
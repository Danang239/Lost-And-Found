<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat akun admin baru
        User::create([
            'name' => 'Admin',  // Nama admin
            'email' => 'admin@example.com',  // Email admin
            'password' => Hash::make('password123'), // Password admin (gunakan hashing untuk keamanan)
            'is_admin' => true,  // Pastikan field 'is_admin' ada pada tabel 'users' dan nilai 'true'
        ]);
    }
}

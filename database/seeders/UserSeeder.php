<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'janesmith@example.com',
                'password' => Hash::make('securepassword'),
                'role' => 'user',
            ],
            [
                'name' => 'Mike Johnson',
                'email' => 'mikejohnson@example.com',
                'password' => Hash::make('mypassword'),
                'role' => 'user',
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emilydavis@example.com',
                'password' => Hash::make('password456'),
                'role' => 'user',
            ],
        ];

        // Loop untuk membuat user hanya jika belum ada di database
        foreach ($users as $user) {
            if (!User::where('email', $user['email'])->exists()) {
                User::create($user);
            }
        }
    }
}

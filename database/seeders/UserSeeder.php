<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'password' => Hash::make('admin123'),
                'name' => 'Admin Laundry',
                'email' => 'admin@gmail.com',
                'alamat' => 'Jl. Kebersihan No.1',
                'no_hp' => '081234567890',
                'role' => 'admin',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'password' => Hash::make('sofi123'),
                'name' => 'Sofi Arindah',
                'email' => 'sofi@gmail.com',
                'alamat' => 'Jl. Kebersihan No.1',
                'no_hp' => '081234567890',
                'role' => 'customer',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

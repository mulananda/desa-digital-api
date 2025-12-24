<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@app.com',
            'password' => Hash::make('password')
        ])->assignRole('admin');

        User::create([
            'name' => 'Kepala Keluarga',
            'email' => 'headoffamily@app.com',
            'password' => Hash::make('password')
        ])->assignRole('head-of-family');

        // buat sedder tanpa table relasi
        UserFactory::new()->count(15)->create();
    }
}

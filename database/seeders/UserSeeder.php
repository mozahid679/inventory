<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@t.t'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('12345678'),
            ]
        );
        $admin->assignRole('admin');
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => config('app.admin_email', 'admin@formation-soudure.com')],
            [
                'name' => 'Mang-Ky Ha',
                'password' => Hash::make(config('app.admin_password', 'changeme')),
                'email_verified_at' => now(),
            ]
        );

        $admin->assignRole('admin');
    }
}

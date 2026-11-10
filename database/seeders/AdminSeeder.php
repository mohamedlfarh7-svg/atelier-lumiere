<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // يقرا الإيميل والباسورد من Render (Environment Variables)
        $email = env('ADMIN_EMAIL', 'default@gmail.com');
        $password = env('ADMIN_PASSWORD', 'default123456');

        User::updateOrCreate(
            ['email'    => $email], // كيقلب على الـ Admin بالـ Role
            [
                'name'     => 'Admin',
                'password' => Hash::make($password),
            ]
        );
    }
}
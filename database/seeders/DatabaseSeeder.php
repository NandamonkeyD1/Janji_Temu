<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@lingsirndalugrosir.com'],
            [
                'name'     => 'Admin Lingsir Ndalu',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
                'no_hp'    => '08123456789',
            ]
        );

        $this->command->info('Admin seeded: admin@lingsirndalugrosir.com / admin123');
    }
}

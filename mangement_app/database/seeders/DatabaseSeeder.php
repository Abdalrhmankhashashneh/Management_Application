<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\admin;
use App\Models\User;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        admin::create([
            'name' => 'admin' ,
            'email' => 'smsmspy@gmail.com',
            'password' => Hash::make('admin'),
        ]);
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => 'user' . $i,
                'email' => 'user' . $i . '@gmail.com',
                'password' => Hash::make('user12345@'),
            ]);
        }

    }
}

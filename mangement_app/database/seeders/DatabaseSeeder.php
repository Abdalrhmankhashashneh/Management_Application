<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\admin;
use App\Models\User;
use App\Models\leavetype;
use App\Models\vacation;
use App\Models\request;
use App\Models\activities;
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
            'name' => 'Abd-Alrahman Khashashneh' ,
            'email' => 'smsmspy@gmail.com',
            'password' => Hash::make('admin'),
        ]);



        for ($i = 1; $i < 6; $i++) {
            User::create([
                'name' => 'employee' . $i,
                'email' => 'user' . $i . '@gmail.com',
                'password' => Hash::make('user12345@'),
                'major' => 'computer science',
            ]);
        }
        leavetype::create([
            'name' => 'clock in - out ',
            'description' => 'clock in - out ',
        ]);
        leavetype::create([
            'name' => 'lunch break',
            'description' => 'lunch break is for 30 minutes',
        ]);
        leavetype::create([
            'name' => 'short break',
            'description' => 'short break is for 15 minutes',
        ]);
        leavetype::create([
            'name' => 'meeting',
            'description' => 'lunch break is for meeting ends',
        ]);

        activities::create([
            'user_id' => 1,
            'leave_id' => 1,
            'start' => '09:00:00',
            'end' => '17:00:00',
            'date' => '2020-08-07',
        ]);
        activities::create([
            'user_id' => 2,
            'leave_id' => 1,
            'start' => '09:00:00',
            'end' => '17:00:00',
            'date' => '2020-08-07',
        ]);
        activities::create([
            'user_id' => 3,
            'leave_id' => 1,
            'start' => '09:00:00',
            'end' => '17:00:00',
            'date' => '2020-08-07',
        ]);
        activities::create([
            'user_id' => 4,
            'leave_id' => 1,
            'start' => '09:00:00',
            'end' => '17:00:00',
            'date' => '2020-08-07',
        ]);

        vacation::create([
            'name' => 'sick off',
            'description' => 'description',
        ]);
        vacation::create([
            'name' => 'vacation off',
            'description' => 'description',
        ]);

        request::create([
            'user_id' => 1,
            'vacation_id' => 1,
            'date' => '2020-08-09',
            'status' => 'pending',
        ]);
        request::create([
            'user_id' => 2,
            'vacation_id' => 2,
            'date' => '2020-08-09',
            'status' => 'pending',
        ]);


    }
}

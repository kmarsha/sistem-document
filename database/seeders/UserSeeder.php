<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'username' => 'marshak',
                'password' => bcrypt('password'),
                'role_id' => '1', 
            ],
            [
                'username' => 'maker2',
                'password' => bcrypt('password'),
                'role_id' => '1', 
            ],
            [
                'username' => 'macca',
                'password' => bcrypt('password'),
                'role_id' => '2',
            ],
        ];

        User::insert($users);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'role_id' => '1',
                'role_name' => 'maker',
            ],
            [
                'role_id' => '2',
                'role_name' => 'approver'
            ],
        ];

        Role::insert($roles);
    }
}

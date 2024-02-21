<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Officer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'administrator',
            'password' => bcrypt('admin'),
            'role' => 'rahasia',
        ]);
        User::create([
            'username' => 'officer',
            'password' => bcrypt('officer'),
            'role' => 'rahasia',
        ]);
        Employee::create([
            'name' => 'employee1',
            'date_of_birth' => '2020-08-17',
            'age' => 24,
            'created_by' => 'default',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        Employee::create([
            'name' => 'employee2',
            'date_of_birth' => '2020-08-17',
            'age' => 24,
            'created_by' => 'default',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        Officer::create([
            'name' => 'Officer1',
            'position' => 'Director',
            'placement' => 'headquarters',
            'created_by' => 'default',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        Officer::create([
            'name' => 'Officer2',
            'position' => 'Manager',
            'placement' => 'branch',
            'created_by' => 'default',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}

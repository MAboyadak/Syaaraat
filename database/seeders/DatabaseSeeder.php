<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Department::factory(3)->create();

        // admin 
        Employee::create([
            'first_name' => 'New',
            'last_name' => 'Manager',
            'email' => 'manager@manager.com',
            'email_verified_at' => now(),
            'phone' => "0123456789",
            'role'  => 'manager',
            'salary'  => 30000,
            'password' => Hash::make('complex password'),
            'remember_token' => Str::random(10),
        ]);
        // employees
        Employee::factory(4)->create();

        Task::factory(12)->create();
    }
}

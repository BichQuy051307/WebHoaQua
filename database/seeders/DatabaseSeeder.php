<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Customer 1',
            'email' => 'customer1@gmail.com',
            'password' => bcrypt('password@123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('password@123'),
        ]);
    }
}

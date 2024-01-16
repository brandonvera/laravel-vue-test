<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            "name" => "admin",
            "email" => "admin@api.com",
            "password" => Hash::make('password'),
            "status" => 1,
            "role" => 1,
            "created_at" => date('Y-m-d H:m:s'),
            "updated_at" => date('Y-m-d H:m:s'),
        ]);

        DB::table('users')->insert([
            "name" => "user",
            "email" => "user@api.com",
            "password" => Hash::make('password'),
            "status" => 1,
            "role" => 0,
            "created_at" => date('Y-m-d H:m:s'),
            "updated_at" => date('Y-m-d H:m:s'),
        ]);
    }
}

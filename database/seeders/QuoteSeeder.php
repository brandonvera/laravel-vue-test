<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quotes')->insert([
            "quote" => "text",
            "author" => "author",
            "user_id" => 2,
            "created_at" => date('Y-m-d H:m:s'),
            "updated_at" => date('Y-m-d H:m:s'),
        ]);
    }
}

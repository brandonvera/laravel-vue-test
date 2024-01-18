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
            "quote" => "Be yourself; everyone else is already taken.",
            "author" => "Oscar Wilde",
            "user_id" => 2,
            "created_at" => date('Y-m-d H:m:s'),
            "updated_at" => date('Y-m-d H:m:s'),
        ]);

        DB::table('quotes')->insert([
            "quote" => "I'm selfish, impatient and a little insecure. I make mistakes, I am out of control and at times hard to handle. But if you can't handle me at my worst, then you sure as hell don't deserve me at my best.",
            "author" => "Marilyn Monroe",
            "user_id" => 2,
            "created_at" => date('Y-m-d H:m:s'),
            "updated_at" => date('Y-m-d H:m:s'),
        ]);

        DB::table('quotes')->insert([
            "quote" => "So many books, so little time.",
            "author" => "Frank Zappa",
            "user_id" => 2,
            "created_at" => date('Y-m-d H:m:s'),
            "updated_at" => date('Y-m-d H:m:s'),
        ]);

        DB::table('quotes')->insert([
            "quote" => "Two things are infinite: the universe and human stupidity; and I'm not sure about the universe.",
            "author" => "Albert Einstein",
            "user_id" => 2,
            "created_at" => date('Y-m-d H:m:s'),
            "updated_at" => date('Y-m-d H:m:s'),
        ]);

        DB::table('quotes')->insert([
            "quote" => "A room without books is like a body without a soul.",
            "author" => "Marcus Tullius Cicero",
            "user_id" => 2,
            "created_at" => date('Y-m-d H:m:s'),
            "updated_at" => date('Y-m-d H:m:s'),
        ]);
    }
}

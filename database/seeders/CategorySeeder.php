<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // template to category
        DB::table('category')->insert([
            ['name' => 'Łóżka'],
            ['name' => 'Krzesła'],
            ['name' => 'Stoły'],
            ['name' => 'Szafy']
        ]);
    }
}

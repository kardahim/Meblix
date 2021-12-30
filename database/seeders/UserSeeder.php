<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            [
                'first_name' => 'Paweł',
                'last_name' => 'Ciszewski',
                'email' => 'kardahim@gmail.com',
                'password' => Hash::make('137590'),
                // 0 - normal customer, 1 - administrator
                'status' => 1,
                'address_id' => 1
            ],
            [
                'first_name' => 'Bob',
                'last_name' => 'Testowy',
                'email' => 'bob.testowy@gmail.com',
                'password' => Hash::make('bob'),
                // 0 - normal customer, 1 - administrator
                'status' => 0,
                'address_id' => 3
            ]
        ]);
    }
}

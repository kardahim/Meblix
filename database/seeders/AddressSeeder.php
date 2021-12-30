<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            [
                'street' => 'Kijany',
                'house_number' => '67',
                'postal_code' => '21-077',
                'location' => 'Kijany'
            ],
            [
                'street' => 'Bursztynowa',
                'house_number' => '64A',
                'postal_code' => '21-077',
                'location' => 'Łęczna'
            ],
            [
                'street' => 'Losowa',
                'house_number' => '2B',
                'postal_code' => '21-077',
                'location' => 'Lublin'
            ],
        ]);
    }
}

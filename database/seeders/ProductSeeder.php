<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'MALM',
                'price' => 649.00,
                'image_link' => 'https://www.ikea.com/pl/pl/images/products/malm-rama-lozka-wysoka-bialy-luroey__0749130_pe745499_s5.jpg?f=xl',
                'description' => 'Proste wzornictwo, równie piękne z każdej strony - łózko może stać w pokoju wolnostojąco lub z wezgłowiem przy ścianie.',
                'category_id' => 1
            ],
            [
                'name' => 'SLATTUM',
                'price' => 599.00,
                'image_link' => 'https://www.ikea.com/pl/pl/images/products/slattum-tapicerowana-rama-lozka-knisa-jasnoszary__0768244_pe754388_s5.jpg?f=xl',
                'description' => 'Tapicerowane miękką tkaniną, która wnosi przytulną atmosferę do sypialni. Wezgłowie stanowi wygodne oparcie dla pleców podczas czytania do późna w nocy.',
                'category_id' => 1
            ],
            [
                'name' => 'TARVA',
                'price' => 599.00,
                'image_link' => 'https://www.ikea.com/pl/pl/images/products/tarva-rama-lozka-sosna-luroey__0637611_pe698421_s5.jpg?f=xl',
                'description' => 'Rama łóżka TARVA to nowoczesny przykład skandynawskiej tradycji meblarskiej - proste wzornictwo i surowe drewno. Ponadczasowy charakter ładnie komponuje się z wieloma innymi stylami i meblami.',
                'category_id' => 1
            ],
            [
                'name' => 'STOCKHOLM 2017',
                'price' => 1199.00,
                'image_link' => 'https://www.ikea.com/pl/pl/images/products/stockholm-2017-fotel-z-poduszka-rattan-graesbo-bialy__0975118_pe812657_s5.jpg?f=xl',
                'description' => 'Będziesz siedzieć wygodnie dzięki wytrzymałym sprężynom kieszeniowym wspierających ciało.',
                'category_id' => 2
            ],
            [
                'name' => 'BUSKBO',
                'price' => 799.00,
                'image_link' => 'https://www.ikea.com/pl/pl/images/products/buskbo-fotel-rattan-djupvik-bialy__0700959_pe723853_s5.jpg?f=xl',
                'description' => 'Wykonany ręcznie przez doświadczonych rzemieślników, dzięki czemu każdy fotel jest wyjątkowy.',
                'category_id' => 2
            ]
        ]);
    }
}

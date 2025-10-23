<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::insert([
            ['name' => 'Diamond Ring', 'price' => 500, 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSaNGyPKj9EiEiU-lWhCEcS68FmoDS8NLsRig&s', 'description' => 'Beautiful diamond ring'],
            ['name' => 'Gold Necklace', 'price' => 250, 'image' => 'images/necklace2.jpeg', 'description' => 'Elegant gold necklace'],
            ['name' => 'Silver Bracelet', 'price' => 120, 'image' => 'images/bracelet3.jpg', 'description' => 'Stylish silver bracelet'],
        ]);
    }
}

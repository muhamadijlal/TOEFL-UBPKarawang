<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'bahasa' => 'inggris',
                'jenis' => 'test',
                'harga' => 250000
            ],
            [
                'bahasa' => 'inggris',
                'jenis' => 'pelatihan',
                'harga' => 200000
            ],
            [
                'bahasa' => 'inggris',
                'jenis' => 'pelatihan dan test',
                'harga' => 350000
            ],
            [
                'bahasa' => 'jepang',
                'jenis' => 'test',
                'harga' => 150000
            ],
            [
                'bahasa' => 'jepang',
                'jenis' => 'pelatihan',
                'harga' => 100000
            ],
            [
                'bahasa' => 'jepang',
                'jenis' => 'pelatihan dan test',
                'harga' => 300000
            ],
        ];

        foreach($products as $product){
            Product::create($product);
        }
    }
}

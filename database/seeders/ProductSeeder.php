<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Produk A',
                'description' => 'Deskripsi produk A',
                'price' => 100000,
                'stock' => 50,
            ],
            [
                'name' => 'Produk B',
                'description' => 'Deskripsi produk B',
                'price' => 150000,
                'stock' => 30,
            ],
            [
                'name' => 'Produk C',
                'description' => 'Deskripsi produk C',
                'price' => 200000,
                'stock' => 20,
            ],
            [
                'name' => 'Produk D',
                'description' => 'Deskripsi produk D',
                'price' => 250000,
                'stock' => 10,
            ],
            [
                'name' => 'Produk E',
                'description' => 'Deskripsi produk E',
                'price' => 300000,
                'stock' => 5,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

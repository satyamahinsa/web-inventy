<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Daftar kategori yang dibutuhkan
        $requiredCategories = [
            'Elektronik',
            'Pakaian',
            'Buku',
            'Mainan',
            'Perabotan'
        ];

        // Cek dan buat kategori jika belum ada
        foreach ($requiredCategories as $categoryName) {
            Category::firstOrCreate(['name' => $categoryName]);
        }

        // Ambil semua kategori dari database setelah dipastikan ada
        $categories = Category::all();

        $products = [
            [
                'name' => 'Iphone 15 Pro Max',
                'description' => 'iPhone 15 Pro Max memiliki layar Super Retina XDR OLED seluas 6,1 inci dengan resolusi 2556 x 1179 piksel.',
                'price' => 15000000,
                'stock' => 10,
                'category_id' => $categories->firstWhere('name', 'Elektronik')->id,
                'image' => 'GambarProduk/15promax.png',
            ],
            [
                'name' => 'Laptop ROG Zephyrus',
                'description' => 'ASUS ROG Zephyrus adalah laptop gaming dengan performa tinggi dan desain ramping.',
                'price' => 30000000,
                'stock' => 5,
                'category_id' => $categories->firstWhere('name', 'Elektronik')->id,
                'image' => 'GambarProduk/laptop.png',
            ],
            [
                'name' => 'Hairdryer',
                'description' => 'Hair dryer untuk pengering rambut yang cepat dan mudah ditata.',
                'price' => 50000,
                'stock' => 20,
                'category_id' => $categories->firstWhere('name', 'Elektronik')->id,
                'image' => 'GambarProduk/Hairdryer.jpg',
            ],
            [
                'name' => 'Kaos',
                'description' => 'Kaos berkualitas nyaman untuk dipakai sehari-hari.',
                'price' => 300000,
                'stock' => 15,
                'category_id' => $categories->firstWhere('name', 'Pakaian')->id,
                'image' => 'GambarProduk/kaos.png',
            ],
            [
                'name' => 'Kemeja Polos',
                'description' => 'Kemeja lembut dengan bahan nyaman dipakai.',
                'price' => 75000,
                'stock' => 30,
                'category_id' => $categories->firstWhere('name', 'Pakaian')->id,
                'image' => 'GambarProduk/Kemejapolos.png',
            ],
            [
                'name' => 'Baju Kebaya',
                'description' => 'Kebaya yang indah dan nyaman, merepresentasikan budaya.',
                'price' => 30000,
                'stock' => 25,
                'category_id' => $categories->firstWhere('name', 'Pakaian')->id,
                'image' => 'GambarProduk/Kebaya.png',
            ],
            [
                'name' => 'Buku Ekonomi',
                'description' => 'Buku Teori Ekonomi dengan informasi ekonomi lengkap.',
                'price' => 50000,
                'stock' => 8,
                'category_id' => $categories->firstWhere('name', 'Buku')->id,
                'image' => 'GambarProduk/Bukuekonomi.jpg',
            ],
            [
                'name' => 'Buku Sains',
                'description' => 'Buku Sains untuk mendalami ilmu sains.',
                'price' => 50000,
                'stock' => 10,
                'category_id' => $categories->firstWhere('name', 'Buku')->id,
                'image' => 'GambarProduk/Bukusains.jpeg',
            ],
            [
                'name' => 'Buku Sosial',
                'description' => 'Buku sosial yang menyajikan konsep hidup harmonis.',
                'price' => 80000,
                'stock' => 50,
                'category_id' => $categories->firstWhere('name', 'Buku')->id,
                'image' => 'GambarProduk/Bukusosial.png',
            ],
            [
                'name' => 'Boneka Anak',
                'description' => 'Boneka anak lembut yang cocok untuk hadiah.',
                'price' => 120000,
                'stock' => 40,
                'category_id' => $categories->firstWhere('name', 'Mainan')->id,
                'image' => 'GambarProduk/Boneka.jpg',
            ],
            [
                'name' => 'Lego',
                'description' => 'Lego untuk melatih kemampuan anak berpikir praktis.',
                'price' => 750000,
                'stock' => 15,
                'category_id' => $categories->firstWhere('name', 'Mainan')->id,
                'image' => 'GambarProduk/Leggo.jpeg',
            ],
            [
                'name' => 'Pistol Mainan',
                'description' => 'Mainan pistol untuk bermain anak.',
                'price' => 70000,
                'stock' => 50,
                'category_id' => $categories->firstWhere('name', 'Mainan')->id,
                'image' => 'GambarProduk/Pistol.jpg',
            ],
            [
                'name' => 'Bak Mandi',
                'description' => 'Bak mandi untuk menyimpan air bersih.',
                'price' => 15000,
                'stock' => 20,
                'category_id' => $categories->firstWhere('name', 'Perabotan')->id,
                'image' => 'GambarProduk/Bak.jpeg',
            ],
            [
                'name' => 'Lemari Kayu',
                'description' => 'Lemari kayu dengan desain elegan dan banyak ruang penyimpanan.',
                'price' => 3500000,
                'stock' => 5,
                'category_id' => $categories->firstWhere('name', 'Perabotan')->id,
                'image' => 'GambarProduk/Lemari.png',
            ],
            [
                'name' => 'Cermin Motif',
                'description' => 'Cermin motif dengan corak elegan.',
                'price' => 50000,
                'stock' => 30,
                'category_id' => $categories->firstWhere('name', 'Perabotan')->id,
                'image' => 'GambarProduk/Cermin.jpeg',
            ],
        ];

        // Insert products
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

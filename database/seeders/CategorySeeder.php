<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; 

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Elektronik',
            'Pakaian',
            'Buku',
            'Perabotan',
            'Mainan'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}

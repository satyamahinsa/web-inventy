<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Services\ProductService; 

class CreateProductTest extends TestCase
{
    public function test_create_product()
    {
        $category = Category::first();
        
        $this->assertNotNull($category, 'Kategori harus tersedia di database sebelum pengujian.');

        $data = [
            'name' => 'Produk Test',
            'description' => 'Deskripsi produk test',
            'price' => 200000,
            'stock' => 5,
            'category_id' => $category->id,
        ];

        $productService = new ProductService(); 

        $product = $productService->createProduct($data);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertDatabaseHas('products', [
            'name' => 'Produk Test',
            'description' => 'Deskripsi produk test',
            'price' => 200000,
            'stock' => 5,
            'category_id' => $category->id,
        ]);
    }
}

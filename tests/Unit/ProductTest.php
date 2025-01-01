<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Services\ProductService;
use Illuminate\Support\Facades\Session;

class ProductTest extends TestCase
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

    public function test_add_to_cart()
    {
        $product = Product::create([
            'name' => 'Produk Test',
            'description' => 'Deskripsi produk test',
            'price' => 200000,
            'stock' => 10,
            'category_id' => Category::first()->id,
        ]);

        $response = $this->post(route('products.addToCart', $product), [
            'quantity' => 2,
        ]);

        $response->assertRedirect(route('products.index'));

        $cart = Session::get('cart');
        $this->assertArrayHasKey($product->id, $cart);
        $this->assertEquals(2, $cart[$product->id]['quantity']);
    }

    public function test_update_product()
    {
        $product = Product::create([
            'name' => 'Produk Lama',
            'description' => 'Deskripsi lama',
            'price' => 100000,
            'stock' => 10,
            'category_id' => Category::first()->id,
        ]);

        $updateData = [
            'name' => 'Produk Baru',
            'description' => 'Deskripsi baru',
            'price' => 150000,
            'stock' => 5,
            'category_id' => $product->category_id,
        ];

        $response = $this->put(route('products.update', $product->id), $updateData);

        $response->assertRedirect(route('products.create'));
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Produk Baru',
            'description' => 'Deskripsi baru',
            'price' => 150000,
            'stock' => 5,
        ]);
    }

    public function test_destroy_product()
    {
        $product = Product::create([
            'name' => 'Produk Test',
            'description' => 'Deskripsi produk test',
            'price' => 200000,
            'stock' => 10,
            'category_id' => Category::first()->id,
        ]);

        $response = $this->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.create'));
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}

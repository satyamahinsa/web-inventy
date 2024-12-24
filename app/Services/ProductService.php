<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    /**
     * Method untuk membuat produk baru.
     *
     * @param array $data
     * @return Product
     */
    public function createProduct(array $data)
    {
        return Product::create($data);
    }
}

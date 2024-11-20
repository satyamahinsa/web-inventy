<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Product;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil produk yang ada dan pastikan memiliki kategori terkait
        $products = Product::all();

        $transactions = [
            [
                'user_id' => 2,
                'shipping_service' => 'JNE',
                'total_price' => 150000,
                'status' => 'pending',
                'destination_address' => 'Jl. Merdeka No. 1, RT 02 RW 03, Kel. Gambir, Kec. Gambir, Jakarta Pusat, 10110',
                'latitude' => -6.175110,
                'longitude' => 106.865039,
                'products' => [
                    ['id' => 1, 'quantity' => 2], // Elektronik
                    ['id' => 2, 'quantity' => 1], // Pakaian
                    ['id' => 3, 'quantity' => 3], // Buku
                ],
            ],
            [
                'user_id' => 3,
                'shipping_service' => 'TIKI',
                'total_price' => 200000,
                'status' => 'completed',
                'destination_address' => 'Jl. Pemuda No. 1, Kel. Tambaksari, Kec. Tambaksari, Surabaya, 60131',
                'latitude' => -7.257472,
                'longitude' => 112.752088,
                'products' => [
                    ['id' => 4, 'quantity' => 2], // Mainan
                    ['id' => 5, 'quantity' => 1], // Perabotan
                ],
            ],
        ];

        foreach ($transactions as $transaction) {
            // Buat transaksi baru
            $transactionRecord = Transaction::create([
                'user_id' => $transaction['user_id'],
                'shipping_service' => $transaction['shipping_service'],
                'total_price' => $transaction['total_price'],
                'status' => $transaction['status'],
                'destination_address' => $transaction['destination_address'],
                'latitude' => $transaction['latitude'],
                'longitude' => $transaction['longitude'],
            ]);

            // Tambahkan produk ke transaksi
            foreach ($transaction['products'] as $productData) {
                $product = $products->find($productData['id']);

                if ($product) {
                    $transactionRecord->products()->attach($product->id, ['quantity' => $productData['quantity']]);
                }
            }
        }
    }
}

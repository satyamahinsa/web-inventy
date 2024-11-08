<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = [
            [
                'user_id' => 1,
                'shipping_service' => 'JNE',
                'total_price' => 150000,
                'status' => 'pending',
                'destination_address' => 'Jl. Merdeka No. 1, RT 02 RW 03, Kel. Gambir, Kec. Gambir, Jakarta Pusat, 10110',
                'latitude' => -6.175110,
                'longitude' => 106.865039,
                'products' => json_encode([
                    ['id' => 1, 'quantity' => 2],
                    ['id' => 2, 'quantity' => 1],
                    ['id' => 3, 'quantity' => 3],
                ]),
            ],
            [
                'user_id' => 1,
                'shipping_service' => 'TIKI',
                'total_price' => 200000,
                'status' => 'completed',
                'destination_address' => 'Jl. Merdeka No. 1, RT 02 RW 03, Kel. Gambir, Kec. Gambir, Jakarta Pusat, 10110',
                'latitude' => -6.175110,
                'longitude' => 106.865039,
                'products' => json_encode([
                    ['id' => 1, 'quantity' => 1],
                    ['id' => 2, 'quantity' => 2],
                    ['id' => 3, 'quantity' => 1],
                ]),
            ],
            [
                'user_id' => 2,
                'shipping_service' => 'Pos Indonesia',
                'total_price' => 100000,
                'status' => 'cancelled',
                'destination_address' => 'Jl. Asia Afrika No. 65, Kel. Braga, Kec. Sumur Bandung, Bandung, 40111',
                'latitude' => -6.921414,
                'longitude' => 107.606938,
                'products' => json_encode([
                    ['id' => 1, 'quantity' => 1],
                    ['id' => 2, 'quantity' => 2],
                    ['id' => 3, 'quantity' => 1],
                ]),
            ],
            [
                'user_id' => 2,
                'shipping_service' => 'JNE',
                'total_price' => 250000,
                'status' => 'pending',
                'destination_address' => 'Jl. Asia Afrika No. 65, Kel. Braga, Kec. Sumur Bandung, Bandung, 40111',
                'latitude' => -6.921414,
                'longitude' => 107.606938,
                'products' => json_encode([
                    ['id' => 1, 'quantity' => 2],
                    ['id' => 2, 'quantity' => 1],
                    ['id' => 3, 'quantity' => 3],
                ]),
            ],
            [
                'user_id' => 3,
                'shipping_service' => 'TIKI',
                'total_price' => 300000,
                'status' => 'completed',
                'destination_address' => 'Jl. Pemuda No. 1, Kel. Tambaksari, Kec. Tambaksari, Surabaya, 60131',
                'latitude' => -7.257472,
                'longitude' => 112.752088,
                'products' => json_encode([
                    ['id' => 1, 'quantity' => 1],
                    ['id' => 2, 'quantity' => 2],
                    ['id' => 3, 'quantity' => 1],
                ]),
            ],
            [
                'user_id' => 1,
                'shipping_service' => 'Gojek',
                'total_price' => 120000,
                'status' => 'pending',
                'destination_address' => 'Jl. Merdeka No. 1, RT 02 RW 03, Kel. Gambir, Kec. Gambir, Jakarta Pusat, 10110',
                'latitude' => -6.175110,
                'longitude' => 106.865039,
                'products' => json_encode([
                    ['id' => 1, 'quantity' => 1],
                    ['id' => 2, 'quantity' => 2],
                    ['id' => 3, 'quantity' => 1],
                ]),
            ],
            [
                'user_id' => 3,
                'shipping_service' => 'Grab',
                'total_price' => 180000,
                'status' => 'completed',
                'destination_address' => 'Jl. Pemuda No. 1, Kel. Tambaksari, Kec. Tambaksari, Surabaya, 60131',
                'latitude' => -7.257472,
                'longitude' => 112.752088,
                'products' => json_encode([
                    ['id' => 1, 'quantity' => 1],
                    ['id' => 2, 'quantity' => 2],
                    ['id' => 3, 'quantity' => 3],
                ]),
            ],
            [
                'user_id' => 2,
                'shipping_service' => 'JNE',
                'total_price' => 220000,
                'status' => 'cancelled',
                'destination_address' => 'Jl. Asia Afrika No. 65, Kel. Braga, Kec. Sumur Bandung, Bandung, 40111',
                'latitude' => -6.921414,
                'longitude' => 107.606938,
                'products' => json_encode([
                    ['id' => 1, 'quantity' => 1],
                    ['id' => 2, 'quantity' => 2],
                    ['id' => 3, 'quantity' => 1],
                ]),
            ],
            [
                'user_id' => 3,
                'shipping_service' => 'Pos Indonesia',
                'total_price' => 140000,
                'status' => 'pending',
                'destination_address' => 'Jl. Pemuda No. 1, Kel. Tambaksari, Kec. Tambaksari, Surabaya, 60131',
                'latitude' => -7.257472,
                'longitude' => 112.752088,
                'products' => json_encode([
                    ['id' => 1, 'quantity' => 1],
                    ['id' => 2, 'quantity' => 1],
                    ['id' => 3, 'quantity' => 2],
                ]),
            ],
            [
                'user_id' => 1,
                'shipping_service' => 'TIKI',
                'total_price' => 170000,
                'status' => 'completed',
                'destination_address' => 'Jl. Merdeka No. 1, RT 02 RW 03, Kel. Gambir, Kec. Gambir, Jakarta Pusat, 10110',
                'latitude' => -6.175110,
                'longitude' => 106.865039,
                'products' => json_encode([
                    ['id' => 1, 'quantity' => 2],
                    ['id' => 2, 'quantity' => 1],
                    ['id' => 3, 'quantity' => 1],
                ]),
            ],
        ];

        foreach ($transactions as $transaction) {
            $transactionRecord = Transaction::create([
                'user_id' => $transaction['user_id'],
                'shipping_service' => $transaction['shipping_service'],
                'total_price' => $transaction['total_price'],
                'status' => $transaction['status'],
                'destination_address' => $transaction['destination_address'],
                'latitude' => $transaction['latitude'],
                'longitude' => $transaction['longitude'],
            ]);

            $products = json_decode($transaction['products'], true);
            foreach ($products as $product) {
                $transactionRecord->products()->attach($product['id'], ['quantity' => $product['quantity']]);
            }
        }
    }
}

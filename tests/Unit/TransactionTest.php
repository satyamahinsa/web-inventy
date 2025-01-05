<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TransactionTest extends TestCase
{
    public function test_index_transactions()
    {
        $user = User::firstOrCreate([
            'email' => 'johndoe@example.com',
        ], [
            'name' => 'John Doe',
            'password' => bcrypt('password'),
        ]);

        Auth::login($user);

        $order = Order::first();

        $transaction = Transaction::first();

        $response = $this->get(route('transactions.index'));

        $response->assertStatus(200);
        $response->assertViewHas('transactions');
    }

    public function test_update_transaction()
    {
        $order = Order::first();

        $transaction = Transaction::first();

        $updateData = [
            'status' => 'completed',
            'alamat-tujuan' => 'Jl. Baru No. 5',
        ];

        $response = $this->put(route('transactions.update', $transaction->id), $updateData);

        $response->assertRedirect(route('transactions.detail', ['id' => $transaction->id]));
        $this->assertDatabaseHas('transactions', [
            'id' => $transaction->id,
            'status' => 'completed',
            'destination_address' => 'Jl. Baru No. 5',
        ]);
    }

    public function test_destroy_transaction()
    {
        $order = Order::create([
            'user_id' => 2,
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '081234567890',
            'address' => 'Jl. Nusantara No. 1',
            'total_amount' => 50000,
            'payment_method' => 'BNI',
            'status' => 'completed',
        ]);

        $transaction = Transaction::create([
            'user_id' => 2,
            'order_id' => $order->id,
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '081234567890',
            'destination_address' => 'Jl. Nusantara No. 1',
            'total_amount' => 50000,
            'payment_method' => 'BNI',
            'status' => 'completed',
        ]);

        $response = $this->delete(route('transactions.destroy', $transaction->id));

        $response->assertRedirect(route('transactions.index'));
        $this->assertDatabaseMissing('transactions', [
            'id' => $transaction->id,
        ]);
    }

    public function test_download_pdf()
    {
        $order = Order::first();

        $transaction = Transaction::first();

        $response = $this->get(route('transactions.download-pdf', $transaction->id));

        $response->assertStatus(200);
        $response->assertViewHas('transaction');
    }
}

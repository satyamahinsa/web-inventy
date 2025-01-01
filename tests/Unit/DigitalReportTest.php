<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DigitalReportTest extends TestCase
{
    public function test_index()
    {
        $transactions = Transaction::take(3)->get();
        $users = User::take(3)->get();
        $products = Product::take(3)->get();

        $this->assertNotEmpty($transactions);
        $this->assertNotEmpty($users);
        $this->assertNotEmpty($products);

        $response = $this->get(route('digital-report.index'));

        $response->assertStatus(200);
        $response->assertViewHasAll([
            'totalTransactions',
            'totalCustomers',
            'totalShippingServices',
            'totalSales',
            'averageOrderValue',
            'completedOrders',
            'totalCategory',
            'totalProduct',
            'topSpender',
        ]);
    }

    public function test_transaction()
    {
        $user = User::first();
        $this->actingAs($user);

        Transaction::take(3)->get()->each(function ($transaction) use ($user) {
            $transaction->update(['user_id' => $user->id]);
        });

        $response = $this->get(route('digital-report.detail-transaction-report'));

        $response->assertStatus(200);
        $response->assertViewHas('transactions', function ($transactions) use ($user) {
            return $transactions->every(fn($transaction) => $transaction->user_id === $user->id);
        });
    }

    public function test_product()
    {
        $user = User::first();
        $this->actingAs($user);

        Product::take(3)->get();

        $response = $this->get(route('digital-report.detail-product-report'));

        $response->assertStatus(200);
        $response->assertViewHas('products', function ($products) {
            return $products->every(fn($product) => isset($product->name) && isset($product->price));
        });
    }

    public function test_user()
    {
        $loggedInUser = User::first();
        $this->actingAs($loggedInUser);

        Transaction::take(3)->get()->each(function ($transaction) use ($loggedInUser) {
            $transaction->update(['user_id' => $loggedInUser->id]);
        });

        $response = $this->get(route('digital-report.detail-user-report'));

        $response->assertStatus(200);
        $response->assertViewHas('users', function ($users) use ($loggedInUser) {
            return $users->contains('id', $loggedInUser->id);
        });
    }
}

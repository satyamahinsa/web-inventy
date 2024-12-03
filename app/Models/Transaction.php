<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'user_id', 'name', 'email', 'phone', 'destination_address', 'total_amount', 'payment_method', 'status'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_transaction')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }    

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

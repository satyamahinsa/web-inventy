<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id', 'name', 'email', 'phone', 'address',
        'total_amount', 'payment_method', 'status'
    ];
}

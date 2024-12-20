<?php

namespace App\Models;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'image',
    ];


    public function category() 
    {
        return $this->belongsTo(Category::class);
    }
    public function orderProducts()
    {
        return $this->belongsToMany(Product::class, 'order_product')
                    ->withPivot('quantity');
    }
    
    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'product_transaction')
                    ->withPivot('quantity');
    } 

}

<?php

namespace App\Models;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'product_id',
        'comment',
        'rating'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'user_id');
    }
}

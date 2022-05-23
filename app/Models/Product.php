<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'discount',
        'image',
        'quantity',
        'description',
        'tag',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_orders', 'product_id', 'order_id' );
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function categorys()
    {
        return $this->hasMany(Category::class);
    }
}
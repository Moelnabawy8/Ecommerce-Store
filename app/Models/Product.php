<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, Notifiable;

    protected $fillable=[
        "name",
        "sale_price",
        "purchase_price",
        "quantity",
        "code",
        "description",
        "status",
        "category_id",
        "seller_id"
    ];
    public function favs()
    {
        return $this->belongsToMany(User::class, 'favs', 'product_id', 'user_id');
    }
    public function carts()
    {
        return $this->belongsToMany(User::class, 'carts', 'product_id', 'user_id')->withPivot('quantity');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    

}

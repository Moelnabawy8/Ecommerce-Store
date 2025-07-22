<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
     use HasFactory, Notifiable;
     protected $fillable=[
        "user_id",
        "product_id",
        "comment",
        "rate"
     ];
        public function user()
        {
            return $this->belongsTo(User::class);
        }
        public function product()
        {
            return $this->belongsTo(Product::class);
        }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
     use HasFactory, Notifiable;
     
     protected $fillable=[
        "name",
        "status"
     ];
        public function products()
        {
            return $this->hasMany(Product::class);
        }
}

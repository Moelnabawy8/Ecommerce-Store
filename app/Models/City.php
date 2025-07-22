<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
     use HasFactory, Notifiable;
     protected $fillable=[
        "name",
        "status"
     ];
     public function regions()
     {
         return $this->hasMany(Region::class);
     }
}

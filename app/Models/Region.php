<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
     use HasFactory, Notifiable;
     protected $fillable=[
        "name",
        "status",
        "city_id"
     ];
        public function city()
        {
            return $this->belongsTo(City::class);
        }
}

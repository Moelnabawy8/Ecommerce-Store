<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{ 
     use HasFactory, Notifiable;
     protected $fillable=[
        "street",
         "building",
         "floor",
         "flat",
         "notes",
         "type",
         "user_id",
         "region_id"
         
     ];
     
     public function user(){
        return $this->belongsTo(User::class);
     }
}

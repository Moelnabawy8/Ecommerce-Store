<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seller extends Model
{
     use HasFactory, Notifiable;
     protected $fillable=[
        "name",
        "shop_name",
        "email",
        "email_verified_at",
        "phone",
        "phone_verified_at",
        "verification_code",
        "password",
        "code_expired_at",
        "remember_token",
        "status"
     ];
     
}

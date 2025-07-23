<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seller extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
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

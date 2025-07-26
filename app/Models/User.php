<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\UserVerifyEmail;


class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
   
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        "status",
        "verification_code",
        "email_verified_at",
        "phone_verfied_at",
        "remember_token"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
     public function addresses(){
       return $this->hasMany(Address::class);
    }
    public function favs()
    {
        return $this->belongsToMany(Product::class, 'favs', 'user_id', 'product_id');
    }
    public function carts()
    {
        return $this->belongsToMany(Product::class, 'carts', 'user_id', 'product_id')->withPivot('quantity');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function sendEmailVerificationNotification()
{
    $this->notify(new UserVerifyEmail);
}
   
}

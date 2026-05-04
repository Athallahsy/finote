<?php

namespace App\Models;

<<<<<<< HEAD
=======
// use Illuminate\Contracts\Auth\MustVerifyEmail;
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;
<<<<<<< HEAD

=======
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

<<<<<<< HEAD
=======
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
    protected $hidden = [
        'password',
        'remember_token',
    ];

<<<<<<< HEAD
=======
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

<<<<<<< HEAD
    public function categories()
=======
    public function category()
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
    {
        return $this->hasMany(Category::class);
    }

<<<<<<< HEAD
    public function transactions()
=======
    public function transaction()
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
    {
        return $this->hasMany(Transaction::class);
    }
}

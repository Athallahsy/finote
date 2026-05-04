<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'user_id',
        'nama',
        'jenis',
    ];

<<<<<<< HEAD
    public function transactions()
=======
    public function transaction()
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
    {
        return $this->hasMany(Transaction::class);
    }

<<<<<<< HEAD
    public function user()
    {
=======
    public function user() {
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
        return $this->belongsTo(User::class);
    }
}

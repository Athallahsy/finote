<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'category_id',
        'judul',
        'jumlah',
        'tanggal',
        'jenis',
        'keterangan',
    ];

<<<<<<< HEAD
    protected $casts = [
        'tanggal' => 'date',
        'jumlah'  => 'integer',
    ];

=======
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

<<<<<<< HEAD
    public function user()
=======
    function user()
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'judul',
        'jumlah',
        'tanggal',
        'jenis',
        'category_id',
        'keterangan',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'nama',
        'jenis',
    ];

    public function transactions()
{
    return $this->hasMany(Transaction::class);
}

}


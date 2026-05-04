<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'kategori',
        'sinopsis',
        'stok',
        'image',
        'ebook',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}

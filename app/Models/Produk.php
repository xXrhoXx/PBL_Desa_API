<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
    'nama_produk', 'deskripsi', 'harga', 'kontak', 'gambar'
];

}

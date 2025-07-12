<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatSKKKK extends Model
{
        use HasFactory;

    protected $table = 'riwayat_hilang_kk';

    protected $fillable = [
        'nama',
        'nik',
        'no_kk',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'status',
        'alamat',
    ];
}

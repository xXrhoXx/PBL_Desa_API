<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatSKBM extends Model
{
        use HasFactory;

    protected $table = 'riwayat_skbm';

    protected $fillable = [
        'nama',
        'nik',
        'no_kk',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'kewarganegaraan',
        'agama',
        'status',
        'alamat',
    ];
}

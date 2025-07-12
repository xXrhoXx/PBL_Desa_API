<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatSKDB extends Model
{
    use HasFactory;

    protected $table = 'riwayat_domisili_baru';

    protected $fillable = [
        'nama',
        'nik',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'agama',
        'status',
        'kewarganegaraan',
        'alamat',
    ];
}

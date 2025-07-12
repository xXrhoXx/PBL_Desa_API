<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatSKTM extends Model
{
    use HasFactory;

    protected $table = 'riwayat_sktm';

    protected $fillable = [
        'nama',
        'nik',
        'no_kk',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'kewarganegaraan',
        'alamat',
    ];
}

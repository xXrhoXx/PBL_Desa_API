<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatSPKV extends Model
{
    use HasFactory;

    protected $table = 'riwayat_SPKV';

    protected $fillable = [
        'nama',
        'nik',
        'no_kk',
        'tgl_lahir',
        'no_bpjs',
        'alamat',
    ];
}

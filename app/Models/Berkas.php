<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    /** @use HasFactory<\Database\Factories\BerkasFactory> */
    use HasFactory;

    protected $table = 'berkas';

    protected $fillable = [
        'berkas_siswa_id',
        'akta_kelahiran',
        'kk',
        'ijazah',
        'sktm',
        'ktp_ayah',
        'ktp_ibu',
        'ktp_wali',
    ];
}

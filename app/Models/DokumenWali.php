<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenWali extends Model
{
    /** @use HasFactory<\Database\Factories\DokumenWaliFactory> */
    use HasFactory;

    protected $table = 'dokumen_wali';

    protected $fillable = [
    'nik_wali',
    'nama_wali',
    'tempat_lahir_wali',
    'tanggal_lahir_wali',
    'status_wali',
    'pendidikan_wali',
    'pekerjaan_wali',
    'domisili_wali',
    'no_hp_wali',
    'penghasilan_wali',
    'alamat_wali',
    'status_tempat_tinggal_wali',
    'wali_id',
    'siswa_id',
    'status_dok_wali',
];

}

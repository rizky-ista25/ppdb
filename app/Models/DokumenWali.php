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
        'siswa_id',

        // Data Ayah
        'nama_ayah',
        'status_ayah',
        'kewarganegaraan_ayah',
        'nik_ayah',
        'tempat_lahir_ayah',
        'tanggal_lahir_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'no_hp_ayah',

        // Data Ibu
        'nama_ibu',
        'status_ibu',
        'kewarganegaraan_ibu',
        'nik_ibu',
        'tempat_lahir_ibu',
        'tanggal_lahir_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'no_hp_ibu',

        // Data Wali
        'nama_wali',
        'status_wali',
        'kewarganegaraan_wali',
        'nik_wali',
        'tempat_lahir_wali',
        'tanggal_lahir_wali',
        'pendidikan_wali',
        'pekerjaan_wali',
        'penghasilan_wali',
        'no_hp_wali',

        'status_dok_ortu',
    ];


}

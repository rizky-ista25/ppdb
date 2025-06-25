<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    /** @use HasFactory<\Database\Factories\AlamatFactory> */
    use HasFactory;

    protected $fillable = [
        // Ayah
        'pemilikan_rumah_ayah',
        'provinsi_ayah',
        'kab_kota_ayah',
        'kecamatan_ayah',
        'kel_des_ayah',
        'rt_ayah',
        'rw_ayah',
        'alamat_ayah',
        'kode_pos_ayah',

        // Ibu
        'pemilikan_rumah_ibu',
        'provinsi_ibu',
        'kab_kota_ibu',
        'kecamatan_ibu',
        'kel_des_ibu',
        'rt_ibu',
        'rw_ibu',
        'alamat_ibu',
        'kode_pos_ibu',

        // Wali
        'pemilikan_rumah_wali',
        'provinsi_wali',
        'kab_kota_wali',
        'kecamatan_wali',
        'kel_des_wali',
        'rt_wali',
        'rw_wali',
        'alamat_wali',
        'kode_pos_wali',

        // Siswa
        'status_tempat_tinggal',
        'provinsi_siswa',
        'kab_kota_siswa',
        'kecamatan_siswa',
        'kel_des_siswa',
        'rt_siswa',
        'rw_siswa',
        'alamat_siswa',
        'kode_pos_siswa',
        'jarak',
        'transportasi',
        'waktu_tempuh',
    ];
}

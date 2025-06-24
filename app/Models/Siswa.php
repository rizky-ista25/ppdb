<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{// Gunakan nama tabel secara eksplisit
    protected $table = 'siswa';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nisn',
        'nis_lokal',
        'kewarganegaraan',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'jumlah_sodara',
        'anakke',
        'cita_cita',
        'no_hp',
        'email',
        'hobi',
        'pembiaya_sekolah',
        'pra_sekolah',
        'kip',
        'kk',
        'kepala_kk',
        'status_dok_siswa',
    ];

}

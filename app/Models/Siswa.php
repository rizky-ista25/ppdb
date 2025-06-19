<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{// Gunakan nama tabel secara eksplisit
    protected $table = 'siswa';

    // (Opsional) Jika tidak memakai kolom timestamps
        protected $fillable = [
        'nama_lengkap', 'nik', 'nisn', 'tempat_lahir', 'tanggal_lahir',
        'agama', 'jenis_kelamin', 'jumlah_sodara', 'anakke', 'hobi',
        'cita_cita', 'no_hp', 'email', 'kebutuhan_disabillitas',
        'kebutuhan_khusus', 'alamat', 'status_tempat_tinggal',
        'jarak_tempat_tinggal', 'waktu_tempuh', 'transportasi',
        'ktp', 'kk', 'dokumen_lainnya'
    ];
}

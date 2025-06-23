<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();

            // Data Pribadi
            $table->string('nama_lengkap');
            $table->string('nik')->unique();
            $table->string('nisn')->unique()->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->integer('jumlah_sodara');
            $table->integer('anakke');
            $table->string('hobi');
            $table->string('cita_cita');
            $table->string('no_hp');
            $table->string('email');
            $table->enum('kebutuhan_disabillitas',['ada', 'tidak']);
            $table->enum('kebutuhan_khusus',['ada', 'tidak']);
            $table->text('alamat');
           $table->enum('status_tempat_tinggal', [
                'BERSAMA ORANG TUA',
                'WALI',
                'ASRAMA',
                'KOST',
                'PANTI ASUHAN',
                'LAINNYA'
            ]);

            $table->enum('jarak_tempat_tinggal', [
                'KURANG DARI 1 KM',
                '1-3 KM',
                '3-5 KM',
                '5-10 KM',
                'LEBIH DARI 10 KM'
            ]);

            $table->enum('waktu_tempuh', [
                'KURANG DARI 15 MENIT',
                '15-30 MENIT',
                '30-60 MENIT',
                'LEBIH DARI 60 MENIT'
            ]);

            $table->enum('transportasi', [
                'JALAN KAKI',
                'SEPEDA',
                'MOTOR',
                'MOBIL PRIBADI',
                'ANGKOT',
                'BUS',
                'KERETA',
                'LAINNYA'
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};

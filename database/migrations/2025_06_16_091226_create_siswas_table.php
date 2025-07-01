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
            $table->foreignId('user_id')->constrained(
                'users'
            );
            
            // Data Pribadi
            $table->string('nama_lengkap');
            $table->string('nisn')->unique();
            $table->string('nis_lokal')->unique()->nullable();
            $table->string('kewarganegaraan');
            $table->string('nik')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->string('agama');
            $table->integer('jumlah_sodara');
            $table->integer('anakke');
            $table->string('cita_cita');
            $table->string('no_hp')->nullable();
            $table->string('email');
            $table->string('hobi');
            $table->string('pembiaya_sekolah');
            $table->string('pra_sekolah');
            $table->string('kip')->nullable();
            $table->string('kk')->unique();
            $table->string('kepala_kk');
            
            $table->string('status_dok_siswa');

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

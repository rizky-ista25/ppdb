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
        Schema::create('dokumen_wali', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained(
                'users'
            );

            // Data Ayah
            $table->string('nama_ayah');
            $table->string('status_ayah');
            $table->string('kewarganegaraan_ayah');
            $table->string('nik_ayah')->unique();
            $table->string('tempat_lahir_ayah')->unique();
            $table->date('tanggal_lahir_ayah');
            $table->string('pendidikan_ayah');            
            $table->string('pekerjaan_ayah');
            $table->string('penghasilan_ayah');
            $table->string('no_hp_ayah')->nullable();

            // Data Ibu
            $table->string('nama_ibu');
            $table->string('status_ibu');
            $table->string('kewarganegaraan_ibu');
            $table->string('nik_ibu')->unique();
            $table->string('tempat_lahir_ibu')->unique();
            $table->date('tanggal_lahir_ibu');
            $table->string('pendidikan_ibu');            
            $table->string('pekerjaan_ibu');
            $table->string('penghasilan_ibu');
            $table->string('no_hp_ibu')->nullable();

            // Data Wali
            $table->string('nama_wali');
            $table->string('status_wali');
            $table->string('kewarganegaraan_wali');
            $table->string('nik_wali')->unique();
            $table->string('tempat_lahir_wali')->unique();
            $table->date('tanggal_lahir_wali');
            $table->string('pendidikan_wali');            
            $table->string('pekerjaan_wali');
            $table->string('penghasilan_wali');
            $table->string('no_hp_wali')->nullable();

            $table->string('status_dok_ortu');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_wali');
    }
};

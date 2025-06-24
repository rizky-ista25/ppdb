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
        Schema::create('alamat', function (Blueprint $table) {
            $table->id();

            // Ayah
            $table->string('pemilikan_rumah_ayah');
            $table->string('provinsi_ayah');
            $table->string('kab_kota_ayah');
            $table->string('kecamatan_ayah');
            $table->string('kel_des_ayah');
            $table->string('rt_ayah');
            $table->string('rw_ayah');
            $table->text('alamat_ayah');
            $table->string('kode_pos_ayah');

            // Ibu
            $table->string('pemilikan_rumah_ibu');
            $table->string('provinsi_ibu');
            $table->string('kab_kota_ibu');
            $table->string('kecamatan_ibu');
            $table->string('kel_des_ibu');
            $table->string('rt_ibu');
            $table->string('rw_ibu');
            $table->text('alamat_ibu');
            $table->string('kode_pos_ibu');

            // Wali
            $table->string('pemilikan_rumah_wali');
            $table->string('provinsi_wali');
            $table->string('kab_kota_wali');
            $table->string('kecamatan_wali');
            $table->string('kel_des_wali');
            $table->string('rt_wali');
            $table->string('rw_wali');
            $table->text('alamat_wali');
            $table->string('kode_pos_wali');

            // Siswa
            $table->string('status_tempat_tinggal');
            $table->string('provinsi_siswa');
            $table->string('kab_kota_siswa');
            $table->string('kecamatan_siswa');
            $table->string('kel_des_siswa');
            $table->string('rt_siswa');
            $table->string('rw_siswa');
            $table->text('alamat_siswa');
            $table->string('kode_pos_siswa');
            $table->string('jarak');
            $table->string('transportasi');
            $table->string('waktu_tempuh');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alamat');
    }
};

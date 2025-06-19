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
            $table->string('nik_wali')->nullable();
            $table->string('nama_wali');
            $table->string('tempat_lahir_wali');
            $table->date('tanggal_lahir_wali');
            $table->enum('status_wali',['masih hidup', 'meninggal dunia']);
            $table->enum('pendidikan_wali',['sd sederajat', 'smp sederajat', 'sma sederajat', ' s1', 's2', 's3']);
            $table->enum('pekerjaan_wali', [
                    'TIDAK BEKERJA',
                    'NELAYAN',
                    'PETANI',
                    'PETERNAK',
                    'PNS TNI POLRI',
                    'KARYAWAN SWASTA',
                    'PEDAGANG KECIL',
                    'PEDAGANG BESAR',
                    'WIRASWASTA',
                    'WIRAUSAHA',
                    'BURUH',
                    'PENSIUNAN',
                    'LAINNYA'
            ]);
            $table->enum('domisili_wali',[' dalam negeri'. 'luar negeri']);
            $table->string('no_hp_wali')->nullable();
            $table->enum('penghasilan_wali', [
                'KURANG DARI 500.000',
                '500.000 - 999.000',
                '1 JUTA - 10 JUTA',
                '10 JUTA - 20 JUTA',
                'LEBIH DARI 20 JUTA',
                'TIDAK ADA PENGHASILAN'
            ]);
            $table->text('alamat_wali');
            $table->enum('status_tempat_tinggal_wali', [
                'milik senidri', 'sewa'
            ]);
            $table->foreignId('wali_id')->constrained(
                'wali_murid'
            );
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timelines = collect([
            // (object)[
            //     'judul' => 'Formulir Dikirim',
            //     'konten' => 'Formulir kamu telah berhasil dikirim dan sedang diproses oleh panitia.',
            //     'icon' => 'fas fa-paper-plane',
            //     'color' => 'bg-blue', // Informasi umum
            //     'created_at' => Carbon::now()->subMinutes(10),
            //     'tanggal' => Carbon::now()->subMinutes(10)->format('d M Y'),
            //     'waktu' => Carbon::now()->subMinutes(10)->format('H:i'),
            // ],
            // (object)[
            //     'judul' => 'Verifikasi Berhasil',
            //     'konten' => 'Berkas kamu telah diverifikasi dan dinyatakan lengkap.',
            //     'icon' => 'fas fa-check-circle',
            //     'color' => 'bg-green', // Berhasil / diterima
            //     'created_at' => Carbon::now()->subHour(),
            //     'tanggal' => Carbon::now()->subHour()->format('d M Y'),
            //     'waktu' => Carbon::now()->subHour()->format('H:i'),
            // ],
            // (object)[
            //     'judul' => 'Data Ditolak',
            //     'konten' => 'Data kamu tidak valid. Mohon lengkapi kembali.',
            //     'icon' => 'fas fa-times-circle',
            //     'color' => 'bg-red', // Error / ditolak
            //     'created_at' => Carbon::now()->subHours(3),
            //     'tanggal' => Carbon::now()->subHours(3)->format('d M Y'),
            //     'waktu' => Carbon::now()->subHours(3)->format('H:i'),
            // ],
            // (object)[
            //     'judul' => 'Menunggu Verifikasi',
            //     'konten' => 'Admin sedang memeriksa berkas kamu. Harap tunggu.',
            //     'icon' => 'fas fa-hourglass-half',
            //     'color' => 'bg-yellow', // Peringatan / menunggu aksi
            //     'created_at' => Carbon::now()->subDays(1),
            //     'tanggal' => Carbon::now()->subDays(1)->format('d M Y'),
            //     'waktu' => Carbon::now()->subDays(1)->format('H:i'),
            // ],
            // (object)[
            //     'judul' => 'Ujian Seleksi',
            //     'konten' => 'Kamu dijadwalkan mengikuti ujian seleksi pada 25 Juni 2025.',
            //     'icon' => 'fas fa-pen',
            //     'color' => 'bg-purple', // Aktivitas spesial / ujian
            //     'created_at' => Carbon::now()->subDays(2),
            //     'tanggal' => Carbon::now()->subDays(2)->format('d M Y'),
            //     'waktu' => Carbon::now()->subDays(2)->format('H:i'),
            // ],
            // (object)[
            //     'judul' => 'Pendaftaran Selesai',
            //     'konten' => 'Selamat! Kamu telah menyelesaikan seluruh proses pendaftaran.',
            //     'icon' => 'fas fa-flag-checkered',
            //     'color' => 'bg-gray', // Tidak aktif / selesai
            //     'created_at' => Carbon::now()->subDays(3),
            //     'tanggal' => Carbon::now()->subDays(3)->format('d M Y'),
            //     'waktu' => Carbon::now()->subDays(3)->format('H:i'),
            // ],
        ]);

        return view('timeline', compact('timelines'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

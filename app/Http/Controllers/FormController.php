<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('form');
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
        $validated = $request->validate([
            'nama_lengkap' => 'required',
            'nik' => 'required|digits:16|unique:siswa,nik',
            'nisn' => 'required|digits:10|unique:siswa,nisn',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'jumlah_sodara' => 'required|integer',
            'anakke' => 'required|integer',
            'hobi' => 'required',
            'cita_cita' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'kebutuhan_disabillitas' => 'required',
            'kebutuhan_khusus' => 'required',
            'alamat' => 'required',
            'status_tempat_tinggal' => 'required',
            'jarak_tempat_tinggal' => 'required',
            'waktu_tempuh' => 'required',
            'transportasi' => 'required',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 angka.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nisn.required' => 'NIK wajib diisi.',
            'nisn.digits' => 'NISN harus terdiri dari 10 angka.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'agama.required' => 'Agama wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus "laki-laki" atau "perempuan".',
            'jumlah_sodara.required' => 'Jumlah saudara wajib diisi.',
            'jumlah_sodara.integer' => 'Jumlah saudara harus berupa angka.',
            'anakke.required' => 'Anak ke-berapa wajib diisi.',
            'anakke.integer' => 'Anak ke harus berupa angka.',
            'hobi.required' => 'Hobi wajib diisi.',
            'cita_cita.required' => 'Cita-cita wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'kebutuhan_disabillitas.required' => 'Kebutuhan disabilitas wajib diisi.',
            'kebutuhan_khusus.required' => 'Kebutuhan khusus wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'status_tempat_tinggal.required' => 'Status tempat tinggal wajib diisi.',
            'jarak_tempat_tinggal.required' => 'Jarak tempat tinggal wajib diisi.',
            'waktu_tempuh.required' => 'Waktu tempuh wajib diisi.',
            'transportasi.required' => 'Transportasi wajib diisi.',
        ]);

        Siswa::create($validated);

        return redirect('/')->with('success', 'Data siswa berhasil disimpan!');

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

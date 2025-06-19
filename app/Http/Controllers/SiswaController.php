<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'nik' => 'required|unique:siswa,nik',
            'nisn' => 'nullable|unique:siswa,nisn',
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
            'ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'dokumen_lainnya' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // Simpan file
        foreach (['ktp', 'kk', 'dokumen_lainnya'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $validated[$fileField] = $request->file($fileField)->store("uploads/{$fileField}", 'public');
            }
        }

       
        Siswa::create($validated);

        return redirect('/')->with('success', 'Data siswa berhasil disimpan!');
        // dd($request->all());
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

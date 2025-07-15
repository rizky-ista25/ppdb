<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Berkas;
use App\Models\DokumenWali;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class PendaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataSiswa = User::where('role', 'siswa')->get();
        return view('pendaftar', compact('dataSiswa'));
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
    public function destroy($id)
    {
        $dataSiswa = User::findOrFail($id);
        $dataSiswa->delete();
        return redirect()->back()->with('status', 'Data siswa berhasil dihapus.');
    }

    public function editSiswa($id)
    {
        $siswa = User::findOrFail($id);
        return view('edit_peserta', compact('siswa'));
    }

    public function updateSiswa(Request $request, $id)
    {
        $siswa = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ],
        [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
        ]
    );
        $siswa->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect()->route('pendaftar')->with('status', 'Data peserta berhasil diupdate.');
    }

    public function detailVerifikasi($nisn)
    {
        $siswa = Siswa::where('nisn',$nisn)->first();
        $berkas = Berkas::where('berkas_siswa_id',$siswa->user_id)->first();
        $statusSiswa = $siswa ? ($siswa->status_dok_siswa ?? '') : '';
        $ortu = DokumenWali::where('siswa_id',$siswa->user_id)->first();
        $statusOrtu = $ortu ? ($ortu->status_dok_ortu ?? '') : '';
        $alamat = Alamat::where('alamatSiswa_id',$siswa->user_id)->first();
        $statusAlamat = $alamat ? ($alamat->status_dok_alamat ?? '') : '';
        return view('detail_verifikasi', compact('siswa','statusSiswa','ortu','statusOrtu','alamat','statusAlamat','berkas'));
    }
}

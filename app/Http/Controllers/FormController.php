<?php

namespace App\Http\Controllers;

use App\Models\DokumenWali;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $statusSiswa = Siswa::where('user_id',$id)->first();
        $statusOrtu = DokumenWali::where('siswa_id',$id)->first();
        
        return view('form',compact(
            'statusSiswa',
            'statusOrtu',
        ));
        
        // return view('form');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function uploadOrtu(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'nik_wali' => 'required|digits:16',
            'nama_wali' => 'required|string|max:255',
            'tempat_lahir_wali' => 'required|string|max:255',
            'tanggal_lahir_wali' => 'required|date|before:today',
            'status_wali' => 'required|in:hidup,meninggal',
            'pendidikan_wali' => 'required',
            'pekerjaan_wali' => 'required',
            'domisili_wali' => 'required',
            'no_hp_wali' => 'required|regex:/^08[0-9]{8,11}$/',
            'penghasilan_wali' => 'required',
            'alamat_wali' => 'required|string',
            'status_tempat_tinggal_wali' => 'required',
            'wali_id' => 'required',
            'siswa_id' => 'required',
            'status_dok_wali' => 'required',
        ], [
            'nik_wali.required' => 'NIK Ayah wajib diisi.',
            'nik_wali.digits' => 'NIK Ayah harus terdiri dari 16 digit.',
            'nama_wali.required' => 'Nama lengkap Ayah wajib diisi.',
            'tempat_lahir_wali.required' => 'Tempat lahir Ayah wajib diisi.',
            'tanggal_lahir_wali.required' => 'Tanggal lahir Ayah wajib diisi.',
            'tanggal_lahir_wali.before' => 'Tanggal lahir harus sebelum hari ini.',
            'status_wali.required' => 'Status Ayah wajib dipilih.',
            'pendidikan_wali.required' => 'Pendidikan terakhir Ayah wajib dipilih.',
            'pekerjaan_wali.required' => 'Pekerjaan Ayah wajib dipilih.',
            'domisili_wali.required' => 'Domisili Ayah wajib dipilih.',
            'no_hp_wali.required' => 'No HP Ayah wajib diisi.',
            'no_hp_wali.regex' => 'No HP Ayah harus dimulai dengan 08 dan berisi 10-13 digit.',
            'penghasilan_wali.required' => 'Penghasilan Ayah wajib dipilih.',
            'alamat_wali.required' => 'Alamat Ayah wajib diisi.',
            'wali_id.required' => '',
            'siswa_id.required' => '',
            'status_dok_wali.required' => '',
            'status_tempat_tinggal_wali.required' => 'Status tempat tinggal wajib dipilih.',
        ]
    );
    if ($validator->fails()) {
        return back()
        ->withErrors($validator, 'ortu')
        ->withInput();
    }
        DokumenWali::create($validator->validate());

        return redirect()->back()->with('success', 'Data ibu berhasil disimpan!');
    }
    public function uploadIbu(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'nik_wali' => 'required|digits:16',
            'nama_wali' => 'required|string|max:255',
            'tempat_lahir_wali' => 'required|string|max:255',
            'tanggal_lahir_wali' => 'required|date|before:today',
            'status_wali' => 'required|in:hidup,meninggal',
            'pendidikan_wali' => 'required',
            'pekerjaan_wali' => 'required',
            'domisili_wali' => 'required',
            'no_hp_wali' => 'required|regex:/^08[0-9]{8,11}$/',
            'penghasilan_wali' => 'required',
            'alamat_wali' => 'required|string',
            'status_tempat_tinggal_wali' => 'required',
            'wali_id' => 'required',
            'siswa_id' => 'required',
            'status_dok_wali' => 'required',
        ], [
            'nik_wali.required' => 'NIK Ibu wajib diisi.',
            'nik_wali.digits' => 'NIK Ibu harus terdiri dari 16 digit.',
            'nama_wali.required' => 'Nama lengkap Ibu wajib diisi.',
            'tempat_lahir_wali.required' => 'Tempat lahir Ibu wajib diisi.',
            'tanggal_lahir_wali.required' => 'Tanggal lahir Ibu wajib diisi.',
            'tanggal_lahir_wali.before' => 'Tanggal lahir harus sebelum hari ini.',
            'status_wali.required' => 'Status Ibu wajib dipilih.',
            'pendidikan_wali.required' => 'Pendidikan terakhir Ibu wajib dipilih.',
            'pekerjaan_wali.required' => 'Pekerjaan Ibu wajib dipilih.',
            'domisili_wali.required' => 'Domisili Ibu wajib dipilih.',
            'no_hp_wali.required' => 'No HP Ibu wajib diisi.',
            'no_hp_wali.regex' => 'No HP Ibu harus dimulai dengan 08 dan berisi 10-13 digit.',
            'penghasilan_wali.required' => 'Penghasilan Ibu wajib dipilih.',
            'alamat_wali.required' => 'Alamat Ibu wajib diisi.',
            'wali_id.required' => '',
            'status_tempat_tinggal_wali.required' => 'Status tempat tinggal wajib dipilih.',
        ]
    );
    if ($validator->fails()) {
        return back()
        ->withErrors($validator, 'ibu')
        ->withInput();
    }
        DokumenWali::create($validator->validate());

        return redirect()->back()->with('success', 'Data ibu berhasil disimpan!');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'user_id' => 'required',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',

            'nik' => 'required|digits:16|unique:siswa,nik',
            'nisn' => 'required|digits:10|unique:siswa,nisn',
            'kewarganegaraan' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'agama' => 'required|string|max:50',

            'jumlah_sodara' => 'required|integer|min:0',
            'anakke' => 'required|integer|min:1',
            'hobi' => 'required|string|max:100',
            'cita_cita' => 'required|string|max:100',

            'no_hp' => 'nullable|regex:/^08[0-9]{8,11}$/',
            'pembiaya_sekolah' => 'required|string|max:100',
            'pra_sekolah' => 'required|string|max:100',
            'kip' => 'nullable|digits:6|unique:siswa,kip',

            'kk' => 'required|digits:16|unique:siswa,kk',
            'kepala_kk' => 'required|string|max:100',


            'status_dok_siswa' => 'required|in:menunggu,diterima,ditolak',
        ], [
            'user_id.required' => 'User wajib diisi.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',

            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 angka.',
            'nik.unique' => 'NIK sudah terdaftar.',

            'nisn.required' => 'NISN wajib diisi.',
            'nisn.digits' => 'NISN harus terdiri dari 10 angka.',
            'nisn.unique' => 'NISN sudah terdaftar.',

            'kip.digits' => 'KIP harus terdiri dari 6 angka.',

            'kewarganegaraan.required' => 'Kewarganegaraan wajib diisi.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus "laki-laki" atau "perempuan".',

            'agama.required' => 'Agama wajib diisi.',
            'jumlah_sodara.required' => 'Jumlah saudara wajib diisi.',
            'jumlah_sodara.integer' => 'Jumlah saudara harus berupa angka.',
            'anakke.required' => 'Anak ke-berapa wajib diisi.',
            'anakke.integer' => 'Anak ke harus berupa angka.',

            'hobi.required' => 'Hobi wajib diisi.',
            'cita_cita.required' => 'Cita-cita wajib diisi.',

            'no_hp.regex' => 'Nomor HP harus dimulai dengan 08 dan terdiri dari 10–13 digit.',
            'pembiaya_sekolah.required' => 'Pembiaya sekolah wajib diisi.',
            'pra_sekolah.required' => 'Pendidikan pra sekolah wajib diisi.',

            'kk.required' => 'Nomor KK wajib diisi.',
            'kk.digits' => 'Nomor KK harus 16 digit.',
            'kk.unique' => 'Nomor KK sudah terdaftar.',
            'kepala_kk.required' => 'Nama kepala keluarga wajib diisi.',


            'status_dok_siswa.required' => 'Status dokumen wajib diisi.',
        ]);

        if ($validated->fails()) {
            return back()->withErrors($validated, 'siswa')->withInput();
        }

        Siswa::create($validated->validate());

        return redirect('/formulir_pribadi')->with('success', 'Data siswa berhasil disimpan!');


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

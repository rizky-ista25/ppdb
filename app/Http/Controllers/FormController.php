<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
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
        $statusAlamat = Siswa::where('alamat_id',$id)->first();
        
        return view('form',compact(
            'statusSiswa',
            'statusOrtu',
            'statusAlamat'
        ));
        
        // return view('form');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function uploadOrtu(Request $request)
    {
        $validator = Validator::make($request->all(), [
                // Siswa
                'siswa_id' => 'exists:users,id',

                // Ayah
                'nama_ayah' => 'string|max:255',
                'status_ayah' => 'in:hidup,meninggal',
                'kewarganegaraan_ayah' => 'string|max:100',
                'nik_ayah' => 'digits:16|unique:dokumen_wali,nik_ayah',
                'tempat_lahir_ayah' => 'string|max:100|unique:dokumen_wali,tempat_lahir_ayah',
                'tanggal_lahir_ayah' => 'date|before:today',
                'pendidikan_ayah' => 'string|max:100',
                'pekerjaan_ayah' => 'string|max:100',
                'penghasilan_ayah' => 'string|max:100',
                'no_hp_ayah' => 'nullable|regex:/^08[0-9]{8,11}$/',

                // Ibu
                'nama_ibu' => 'string|max:255',
                'status_ibu' => 'in:hidup,meninggal',
                'kewarganegaraan_ibu' => 'string|max:100',
                'nik_ibu' => 'digits:16|unique:dokumen_wali,nik_ibu',
                'tempat_lahir_ibu' => 'string|max:100|unique:dokumen_wali,tempat_lahir_ibu',
                'tanggal_lahir_ibu' => 'date|before:today',
                'pendidikan_ibu' => 'string|max:100',
                'pekerjaan_ibu' => 'string|max:100',
                'penghasilan_ibu' => 'string|max:100',
                'no_hp_ibu' => 'nullable|regex:/^08[0-9]{8,11}$/',

                // Wali
                'nama_wali' => 'string|max:255',
                'status_wali' => 'in:hidup,meninggal',
                'kewarganegaraan_wali' => 'string|max:100',
                'nik_wali' => 'digits:16|unique:dokumen_wali,nik_wali',
                'tempat_lahir_wali' => 'string|max:100|unique:dokumen_wali,tempat_lahir_wali',
                'tanggal_lahir_wali' => 'date|before:today',
                'pendidikan_wali' => 'string|max:100',
                'pekerjaan_wali' => 'string|max:100',
                'penghasilan_wali' => 'string|max:100',
                'no_hp_wali' => 'nullable|regex:/^08[0-9]{8,11}$/',
            ], 
            [
                // Siswa
                
                'siswa_id.exists' => 'Siswa yang dipilih tidak valid.',

                // Ayah
                
                'nama_ayah.string' => 'Nama ayah harus berupa teks.',
                'nama_ayah.max' => 'Nama ayah maksimal 255 karakter.',

                
                'status_ayah.in' => 'Status ayah harus "hidup" atau "meninggal".',

                
                'kewarganegaraan_ayah.string' => 'Kewarganegaraan ayah harus harus dipilih.',
                'kewarganegaraan_ayah.max' => 'Kewarganegaraan ayah maksimal 100 karakter.',

                
                'nik_ayah.digits' => 'NIK ayah harus terdiri dari 16 digit.',
                'nik_ayah.unique' => 'NIK ayah sudah terdaftar.',

                
                'tempat_lahir_ayah.string' => 'Tempat lahir ayah harus berupa teks.',
                'tempat_lahir_ayah.max' => 'Tempat lahir ayah maksimal 100 karakter.',
                'tempat_lahir_ayah.unique' => 'Tempat lahir ayah sudah terdaftar.',

                
                'tanggal_lahir_ayah.date' => 'Tanggal lahir ayah harus berupa tanggal yang valid.',
                'tanggal_lahir_ayah.before' => 'Tanggal lahir ayah harus sebelum hari ini.',

                
                'pendidikan_ayah.string' => 'Pendidikan ayah harus berupa teks.',
                'pendidikan_ayah.max' => 'Pendidikan ayah maksimal 100 karakter.',

                
                'pekerjaan_ayah.string' => 'Pekerjaan ayah harus berupa teks.',
                'pekerjaan_ayah.max' => 'Pekerjaan ayah maksimal 100 karakter.',

                
                'penghasilan_ayah.string' => 'Penghasilan ayah harus berupa teks.',
                'penghasilan_ayah.max' => 'Penghasilan ayah maksimal 100 karakter.',

                'no_hp_ayah.regex' => 'Nomor HP ayah tidak valid. Contoh: 08xxxxxxxxxx.',

                // Ibu
                
                'nama_ibu.string' => 'Nama ibu harus berupa teks.',
                'nama_ibu.max' => 'Nama ibu maksimal 255 karakter.',

                
                'status_ibu.in' => 'Status ibu harus "hidup" atau "meninggal".',

                
                'kewarganegaraan_ibu.string' => 'Kewarganegaraan ibu harus dipilih.',
                'kewarganegaraan_ibu.max' => 'Kewarganegaraan ibu maksimal 100 karakter.',

                
                'nik_ibu.digits' => 'NIK ibu harus terdiri dari 16 digit.',
                'nik_ibu.unique' => 'NIK ibu sudah terdaftar.',

                
                'tempat_lahir_ibu.string' => 'Tempat lahir ibu harus berupa teks.',
                'tempat_lahir_ibu.max' => 'Tempat lahir ibu maksimal 100 karakter.',
                'tempat_lahir_ibu.unique' => 'Tempat lahir ibu sudah terdaftar.',

                
                'tanggal_lahir_ibu.date' => 'Tanggal lahir ibu harus berupa tanggal yang valid.',
                'tanggal_lahir_ibu.before' => 'Tanggal lahir ibu harus sebelum hari ini.',

                
                'pendidikan_ibu.string' => 'Pendidikan ibu harus berupa teks.',
                'pendidikan_ibu.max' => 'Pendidikan ibu maksimal 100 karakter.',

                
                'pekerjaan_ibu.string' => 'Pekerjaan ibu harus berupa teks.',
                'pekerjaan_ibu.max' => 'Pekerjaan ibu maksimal 100 karakter.',

                
                'penghasilan_ibu.string' => 'Penghasilan ibu harus berupa teks.',
                'penghasilan_ibu.max' => 'Penghasilan ibu maksimal 100 karakter.',

                'no_hp_ibu.regex' => 'Nomor HP ibu tidak valid. Contoh: 08xxxxxxxxxx.',

                // Wali
                
                'nama_wali.string' => 'Nama wali harus berupa teks.',
                'nama_wali.max' => 'Nama wali maksimal 255 karakter.',

                
                'status_wali.in' => 'Status wali harus "hidup" atau "meninggal".',

                
                'kewarganegaraan_wali.string' => 'Kewarganegaraan wali harus berupa teks.',
                'kewarganegaraan_wali.max' => 'Kewarganegaraan wali maksimal 100 karakter.',

                
                'nik_wali.digits' => 'NIK wali harus terdiri dari 16 digit.',
                'nik_wali.unique' => 'NIK wali sudah terdaftar.',

                
                'tempat_lahir_wali.string' => 'Tempat lahir wali harus berupa teks.',
                'tempat_lahir_wali.max' => 'Tempat lahir wali maksimal 100 karakter.',
                'tempat_lahir_wali.unique' => 'Tempat lahir wali sudah terdaftar.',

                
                'tanggal_lahir_wali.date' => 'Tanggal lahir wali harus berupa tanggal yang valid.',
                'tanggal_lahir_wali.before' => 'Tanggal lahir wali harus sebelum hari ini.',

                
                'pendidikan_wali.string' => 'Pendidikan wali harus berupa teks.',
                'pendidikan_wali.max' => 'Pendidikan wali maksimal 100 karakter.',

                
                'pekerjaan_wali.string' => 'Pekerjaan wali harus berupa teks.',
                'pekerjaan_wali.max' => 'Pekerjaan wali maksimal 100 karakter.',

                
                'penghasilan_wali.string' => 'Penghasilan wali harus berupa teks.',
                'penghasilan_wali.max' => 'Penghasilan wali maksimal 100 karakter.',

                'no_hp_wali.regex' => 'Nomor HP wali tidak valid. Contoh: 08xxxxxxxxxx.',
            ]
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'ortu')
                ->withInput();
        }

        // Simpan data ke tabel
        DokumenWali::create($validator->validated());

        return redirect()->back()
        ->with('success', 'Data orang tua berhasil disimpan')
        ->with('info', 'Silakan lanjut formulir alamat!');
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

        return redirect()->back()
        ->with('success', 'Data siswa berhasil disimpan')
        ->with('info', 'Silakan lanjut formulir orang tua!');
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

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
        $statusAlamat = Alamat::where('alamatSiswa_id',$id)->first();
        
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
                'kewarganegaraan_ayah' => 'max:100',
                'nik_ayah' => 'digits:16|unique:dokumen_wali,nik_ayah',
                'tempat_lahir_ayah' => 'string|max:100|unique:dokumen_wali,tempat_lahir_ayah',
                'tanggal_lahir_ayah' => 'date|before:today',
                'pendidikan_ayah' => 'max:100',
                'pekerjaan_ayah' => 'max:100',
                'penghasilan_ayah' => 'max:100',
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

                'status_dok_ortu' => 'string',

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

        $data = $validator->validated();


        $data['nik_ayah'] = $data['nik_ayah'] ?? '';
        $data['tempat_lahir_ayah'] = $data['tempat_lahir_ayah'] ?? '';
        $data['kewarganegaraan_ayah'] = $data['kewarganegaraan_ayah'] ?? '';
        $data['pendidikan_ayah'] = $data['pendidikan_ayah'] ?? '';
        $data['pekerjaan_ayah'] = $data['pekerjaan_ayah'] ?? '';
        $data['penghasilan_ayah'] = $data['penghasilan_ayah'] ?? '';
        $data['tanggal_lahir_ayah'] = $data['tanggal_lahir_ayah'] ?? null;


        $data['nik_ibu'] = $data['nik_ibu'] ?? '';
        $data['tempat_lahir_ibu'] = $data['tempat_lahir_ibu'] ?? '';
        $data['kewarganegaraan_ibu'] = $data['kewarganegaraan_ibu'] ?? '';
        $data['pendidikan_ibu'] = $data['pendidikan_ibu'] ?? '';
        $data['pekerjaan_ibu'] = $data['pekerjaan_ibu'] ?? '';
        $data['penghasilan_ibu'] = $data['penghasilan_ibu'] ?? '';
        $data['tanggal_lahir_ibu'] = $data['tanggal_lahir_ibu'] ?? null;


        $data['nik_wali'] = $data['nik_wali'] ?? '';
        $data['tempat_lahir_wali'] = $data['tempat_lahir_wali'] ?? '';
        $data['kewarganegaraan_wali'] = $data['kewarganegaraan_wali'] ?? '';
        $data['pendidikan_wali'] = $data['pendidikan_wali'] ?? '';
        $data['pekerjaan_wali'] = $data['pekerjaan_wali'] ?? '';
        $data['penghasilan_wali'] = $data['penghasilan_wali'] ?? '';
        $data['tanggal_lahir_wali'] = $data['tanggal_lahir_wali'] ?? null;

        DokumenWali::create($data);


        return redirect()->back()
        ->with('success_ortu', 'Data orang tua berhasil disimpan')
        ->with('info_ortu', 'Silakan lanjut formulir alamat!');
    }

    public function uploadAlamat(Request $request)
    {
        $userId = Auth::id(); // Mengambil ID user yang sedang login

        // Validasi input
        $validator = Validator::make($request->all(), [
            // Ayah
            'pemilikan_rumah_ayah' => 'string|max:255',
            'provinsi_ayah' => 'string|max:255',
            'kab_kota_ayah' => 'string|max:255',
            'kecamatan_ayah' => 'string|max:255',
            'kel_des_ayah' => 'string|max:255',
            'rt_ayah' => 'string|max:10',
            'rw_ayah' => 'string|max:10',
            'alamat_ayah' => 'string',
            'kode_pos_ayah' => 'string|max:10',

            // Ibu
            'pemilikan_rumah_ibu' => 'string|max:255',
            'provinsi_ibu' => 'string|max:255',
            'kab_kota_ibu' => 'string|max:255',
            'kecamatan_ibu' => 'string|max:255',
            'kel_des_ibu' => 'string|max:255',
            'rt_ibu' => 'string|max:10',
            'rw_ibu' => 'string|max:10',
            'alamat_ibu' => 'string',
            'kode_pos_ibu' => 'string|max:10',

            // Wali
            'pemilikan_rumah_wali' => 'required|string|max:255',
            'provinsi_wali' => 'required|string|max:255',
            'kab_kota_wali' => 'required|string|max:255',
            'kecamatan_wali' => 'required|string|max:255',
            'kel_des_wali' => 'required|string|max:255',
            'rt_wali' => 'required|string|max:10',
            'rw_wali' => 'required|string|max:10',
            'alamat_wali' => 'required|string',
            'kode_pos_wali' => 'required|string|max:10',

            // Siswa
            'status_tempat_tinggal' => 'required|string|max:255',
            'provinsi_siswa' => 'required|string|max:255',
            'kab_kota_siswa' => 'required|string|max:255',
            'kecamatan_siswa' => 'required|string|max:255',
            'kel_des_siswa' => 'required|string|max:255',
            'rt_siswa' => 'required|string|max:10',
            'rw_siswa' => 'required|string|max:10',
            'alamat_siswa' => 'required|string',
            'kode_pos_siswa' => 'required|string|max:10',
            'jarak' => 'required|string|max:255',
            'transportasi' => 'required|string|max:255',
            'waktu_tempuh' => 'required|string|max:255',

            
            ],
            [
                // 🔻 Ayah
                // 'pemilikan_rumah_ayah.required' => 'Status kepemilikan rumah ayah wajib diisi.',
                'pemilikan_rumah_ayah.string' => 'Status kepemilikan rumah ayah wajib diisi.',
                'provinsi_ayah.string' => 'Provinsi tempat tinggal ayah wajib diisi.',
                'kab_kota_ayah.string' => 'Kabupaten/Kota tempat tinggal ayah wajib diisi.',
                'kecamatan_ayah.string' => 'Kecamatan tempat tinggal ayah wajib diisi.',
                'kel_des_ayah.string' => 'Kelurahan/Desa tempat tinggal ayah wajib diisi.',
                'rt_ayah.string' => 'RT ayah wajib diisi.',
                'rw_ayah.string' => 'RW ayah wajib diisi.',
                'alamat_ayah.string' => 'Alamat lengkap ayah wajib diisi.',
                'kode_pos_ayah.string' => 'Kode pos ayah wajib diisi.',

                // 🔻 Ibu
                'pemilikan_rumah_ibu.string' => 'Status kepemilikan rumah ibu wajib diisi.',
                'provinsi_ibu.string' => 'Provinsi tempat tinggal ibu wajib diisi.',
                'kab_kota_ibu.string' => 'Kabupaten/Kota tempat tinggal ibu wajib diisi.',
                'kecamatan_ibu.string' => 'Kecamatan tempat tinggal ibu wajib diisi.',
                'kel_des_ibu.string' => 'Kelurahan/Desa tempat tinggal ibu wajib diisi.',
                'rt_ibu.string' => 'RT ibu wajib diisi.',
                'rw_ibu.string' => 'RW ibu wajib diisi.',
                'alamat_ibu.string' => 'Alamat lengkap ibu wajib diisi.',
                'kode_pos_ibu.string' => 'Kode pos ibu wajib diisi.',

                // 🔻 Wali
                'pemilikan_rumah_wali.required' => 'Status kepemilikan rumah wali wajib diisi.',
                'provinsi_wali.required' => 'Provinsi tempat tinggal wali wajib diisi.',
                'kab_kota_wali.required' => 'Kabupaten/Kota tempat tinggal wali wajib diisi.',
                'kecamatan_wali.required' => 'Kecamatan tempat tinggal wali wajib diisi.',
                'kel_des_wali.required' => 'Kelurahan/Desa tempat tinggal wali wajib diisi.',
                'rt_wali.required' => 'RT wali wajib diisi.',
                'rw_wali.required' => 'RW wali wajib diisi.',
                'alamat_wali.required' => 'Alamat lengkap wali wajib diisi.',
                'kode_pos_wali.required' => 'Kode pos wali wajib diisi.',

                // 🔻 Siswa
                'status_tempat_tinggal.required' => 'Status tempat tinggal siswa wajib diisi.',
                'provinsi_siswa.required' => 'Provinsi tempat tinggal siswa wajib diisi.',
                'kab_kota_siswa.required' => 'Kabupaten/Kota tempat tinggal siswa wajib diisi.',
                'kecamatan_siswa.required' => 'Kecamatan tempat tinggal siswa wajib diisi.',
                'kel_des_siswa.required' => 'Kelurahan/Desa tempat tinggal siswa wajib diisi.',
                'rt_siswa.required' => 'RT siswa wajib diisi.',
                'rw_siswa.required' => 'RW siswa wajib diisi.',
                'alamat_siswa.required' => 'Alamat lengkap siswa wajib diisi.',
                'kode_pos_siswa.required' => 'Kode pos siswa wajib diisi.',
                'jarak.required' => 'Jarak rumah ke sekolah wajib diisi.',
                'transportasi.required' => 'Transportasi yang digunakan wajib diisi.',
                'waktu_tempuh.required' => 'Waktu tempuh ke sekolah wajib diisi.',

            ]
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'alamat')
                ->withInput();
        }

        // Simpan data ke database
        $validatedData = $validator->validated();
        $validatedData['alamatSiswa_id'] = $userId;
        $validatedData['status_dok_alamat'] = 'menunggu';

        $validatedData['pemilikan_rumah_ayah'] = $validatedData['pemilikan_rumah_ayah'] ?? '';
        $validatedData['provinsi_ayah'] = $validatedData['provinsi_ayah'] ?? '';
        $validatedData['kab_kota_ayah'] = $validatedData['kab_kota_ayah'] ?? '';
        $validatedData['kecamatan_ayah'] = $validatedData['kecamatan_ayah'] ?? '';
        $validatedData['kel_des_ayah'] = $validatedData['kel_des_ayah'] ?? '';
        $validatedData['rw_ayah'] = $validatedData['rw_ayah'] ?? '';
        $validatedData['rt_ayah'] = $validatedData['rt_ayah'] ?? '';
        $validatedData['alamat_ayah'] = $validatedData['alamat_ayah'] ?? '';
        $validatedData['kode_pos_ayah'] = $validatedData['kode_pos_ayah'] ?? '';


        $validatedData['pemilikan_rumah_ibu'] = $validatedData['pemilikan_rumah_ibu'] ?? '';
        $validatedData['provinsi_ibu'] = $validatedData['provinsi_ibu'] ?? '';
        $validatedData['kab_kota_ibu'] = $validatedData['kab_kota_ibu'] ?? '';
        $validatedData['kecamatan_ibu'] = $validatedData['kecamatan_ibu'] ?? '';
        $validatedData['kel_des_ibu'] = $validatedData['kel_des_ibu'] ?? '';
        $validatedData['rw_ibu'] = $validatedData['rw_ibu'] ?? '';
        $validatedData['rt_ibu'] = $validatedData['rt_ibu'] ?? '';
        $validatedData['alamat_ibu'] = $validatedData['alamat_ibu'] ?? '';
        $validatedData['kode_pos_ibu'] = $validatedData['kode_pos_ibu'] ?? '';

        Alamat::create($validatedData);

        return redirect()->back()
        ->with('success_alamat', 'Semua formulir telah diisi dengan benar.')
        ->with('info_alamat', 'Silahkan lihat statusnya dihalaman formulir!');
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
        ->with('success_siswa', 'Data siswa berhasil disimpan')
        ->with('info_siswa', 'Silakan lanjut formulir orang tua!');
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

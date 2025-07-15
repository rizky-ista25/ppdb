<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::where('user_id', Auth::user()->id)->first();
        $berkas = Berkas::where('berkas_siswa_id', Auth::user()->id)->first();
        return view('berkas', compact('siswa', 'berkas'));
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
        $validate = $request->validate([
            'berkas_siswa_id' => 'required',
            'akta_kelahiran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'ijazah' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'sktm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'ktp_ayah' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'ktp_ibu' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'ktp_wali' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ], [
            'berkas_siswa_id.required' => 'Siswa wajib diunggah.',

            'akta_kelahiran.required' => 'Akta Kelahiran wajib diunggah.',
            'akta_kelahiran.file' => 'Akta Kelahiran harus berupa file.',
            'akta_kelahiran.mimes' => 'Akta Kelahiran harus berupa file JPG, JPEG, PNG, atau PDF.',
            'akta_kelahiran.max' => 'Ukuran file Akta Kelahiran maksimal 2MB.',

            'kk.required' => 'Kartu Keluarga wajib diunggah.',
            'kk.file' => 'Kartu Keluarga harus berupa file.',
            'kk.mimes' => 'Kartu Keluarga harus berupa file JPG, JPEG, PNG, atau PDF.',
            'kk.max' => 'Ukuran file Kartu Keluarga maksimal 2MB.',

            'ijazah.required' => 'Ijazah wajib diunggah.',
            'ijazah.file' => 'Ijazah harus berupa file.',
            'ijazah.mimes' => 'Ijazah harus berupa file JPG, JPEG, PNG, atau PDF.',
            'ijazah.max' => 'Ukuran file Ijazah maksimal 2MB.',

            'sktm.file' => 'SKTM harus berupa file.',
            'sktm.mimes' => 'SKTM harus berupa file JPG, JPEG, PNG, atau PDF.',
            'sktm.max' => 'Ukuran file SKTM maksimal 2MB.',

            'ktp_ayah.required' => 'KTP Ayah wajib diunggah.',
            'ktp_ayah.file' => 'KTP Ayah harus berupa file.',
            'ktp_ayah.mimes' => 'KTP Ayah harus berupa file JPG, JPEG, PNG, atau PDF.',
            'ktp_ayah.max' => 'Ukuran file KTP Ayah maksimal 2MB.',

            'ktp_ibu.required' => 'KTP Ibu wajib diunggah.',
            'ktp_ibu.file' => 'KTP Ibu harus berupa file.',
            'ktp_ibu.mimes' => 'KTP Ibu harus berupa file JPG, JPEG, PNG, atau PDF.',
            'ktp_ibu.max' => 'Ukuran file KTP Ibu maksimal 2MB.',

            'ktp_wali.file' => 'KTP Wali harus berupa file.',
            'ktp_wali.mimes' => 'KTP Wali harus berupa file JPG, JPEG, PNG, atau PDF.',
            'ktp_wali.max' => 'Ukuran file KTP Wali maksimal 2MB.',
        ]);

        $data = $validate;

        foreach ([
            'akta_kelahiran', 'kk', 'ijazah', 'sktm', 'ktp_ayah', 'ktp_ibu', 'ktp_wali'
        ] as $field) {
            if ($request->hasFile($field)) {
                // Ambil NISN dari tabel siswa berdasarkan user yang sedang login
                $siswa = Siswa::where('user_id', auth()->id())->first();
                $nisn = $siswa ? $siswa->nisn : 'tanpa_nisn';
                $folder = "uploads/berkas_{$nisn}";

                $file = $request->file($field);
                $timestamp = now()->format('Ymd_His');
                $originalName = $file->getClientOriginalName();
                $filename = "{$timestamp}_{$field}_{$nisn}." . $originalName;

                // Simpan file ke folder, tapi hanya simpan nama file ke database
                $file->storeAs($folder, $filename, 'public');
                $data[$field] = $filename;
            }
        }

        Berkas::create($data);
        return redirect()->back()->with('success', 'Berkas berhasil diupload.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $berkas = Berkas::findOrFail($id);

        // Ambil NISN dari tabel siswa berdasarkan user yang sedang login
        $siswa = Siswa::where('user_id', $berkas->berkas_siswa_id)->first();
        $nisn = $siswa ? $siswa->nisn : 'tanpa_nisn';
        $folder = "uploads/berkas_{$nisn}";

        // Hapus semua file yang terkait jika ada
        foreach ([
            'akta_kelahiran', 'kk', 'ijazah', 'sktm', 'ktp_ayah', 'ktp_ibu', 'ktp_wali'
        ] as $field) {
            if ($berkas->$field) {
                \Storage::disk('public')->delete($folder . '/' . $berkas->$field);
            }
        }

        $berkas->delete();

        return redirect()->back()->with('success', 'Berkas berhasil dihapus.');
    }

    public function updates(Request $request){
        dd($request->all());
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'berkas_siswa_id' => 'required',
            'akta_kelahiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'ijazah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'sktm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'ktp_ayah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'ktp_ibu' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'ktp_wali' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ], [
            'berkas_siswa_id.required' => 'Siswa wajib diunggah.',

            'akta_kelahiran.file' => 'Akta Kelahiran harus berupa file.',
            'akta_kelahiran.mimes' => 'Akta Kelahiran harus berupa file JPG, JPEG, PNG, atau PDF.',
            'akta_kelahiran.max' => 'Ukuran file Akta Kelahiran maksimal 2MB.',

            'kk.file' => 'Kartu Keluarga harus berupa file.',
            'kk.mimes' => 'Kartu Keluarga harus berupa file JPG, JPEG, PNG, atau PDF.',
            'kk.max' => 'Ukuran file Kartu Keluarga maksimal 2MB.',

            'ijazah.file' => 'Ijazah harus berupa file.',
            'ijazah.mimes' => 'Ijazah harus berupa file JPG, JPEG, PNG, atau PDF.',
            'ijazah.max' => 'Ukuran file Ijazah maksimal 2MB.',

            'sktm.file' => 'SKTM harus berupa file.',
            'sktm.mimes' => 'SKTM harus berupa file JPG, JPEG, PNG, atau PDF.',
            'sktm.max' => 'Ukuran file SKTM maksimal 2MB.',

            'ktp_ayah.file' => 'KTP Ayah harus berupa file.',
            'ktp_ayah.mimes' => 'KTP Ayah harus berupa file JPG, JPEG, PNG, atau PDF.',
            'ktp_ayah.max' => 'Ukuran file KTP Ayah maksimal 2MB.',

            'ktp_ibu.file' => 'KTP Ibu harus berupa file.',
            'ktp_ibu.mimes' => 'KTP Ibu harus berupa file JPG, JPEG, PNG, atau PDF.',
            'ktp_ibu.max' => 'Ukuran file KTP Ibu maksimal 2MB.',

            'ktp_wali.file' => 'KTP Wali harus berupa file.',
            'ktp_wali.mimes' => 'KTP Wali harus berupa file JPG, JPEG, PNG, atau PDF.',
            'ktp_wali.max' => 'Ukuran file KTP Wali maksimal 2MB.',
        ]);

        $berkas = Berkas::where('berkas_siswa_id', $request->berkas_siswa_id)->first();

        $data = $validate;

        foreach ([
            'akta_kelahiran', 'kk', 'ijazah', 'sktm', 'ktp_ayah', 'ktp_ibu', 'ktp_wali'
        ] as $field) {
            if ($request->hasFile($field)) {
                // Ambil NISN dari tabel siswa berdasarkan user yang sedang login
                $siswa = Siswa::where('user_id', auth()->id())->first();
                $nisn = $siswa ? $siswa->nisn : 'tanpa_nisn';
                $folder = "uploads/berkas_{$nisn}";

                // Hapus file lama jika ada
                if ($berkas->$field) {
                    Storage::disk('public')->delete($folder . '/' . $berkas->$field);
                }

                $file = $request->file($field);
                $timestamp = now()->format('Ymd_His');
                $originalName = $file->getClientOriginalName();
                $filename = "{$timestamp}_{$field}_{$nisn}." . $originalName;

                // Simpan file ke folder, hanya simpan nama file ke database
                $file->storeAs($folder, $filename, 'public');
                $data[$field] = $filename;
            } else {
                // Jika tidak ada file baru, jangan update field file (biarkan yang lama)
                unset($data[$field]);
            }
        }

        $berkas->update($data);
        return redirect()->back()->with('success', 'Berkas berhasil diupdate.');
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
     * Remove the specified resource from storage.
     */
    
}

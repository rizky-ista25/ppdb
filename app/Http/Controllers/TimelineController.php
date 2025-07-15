<?php

namespace App\Http\Controllers;

use App\Models\Timeline;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timelines = Timeline::orderByDesc('created_at')->get();

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
        // Validasi data input
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'icon' => 'required|string',
            'color' => 'required|string',
        ],
            [
            'judul.required' => 'Judul wajib diisi.',
            'judul.max' => 'Judul tidak boleh lebih dari 255 karakter.',

            'konten.required' => 'Isi tidak boleh kosong.',

            'icon.required' => 'Pilih salah satu ikon.',
            'icon.string' => 'Format ikon tidak valid.',

            'color.required' => 'Pilih salah satu warna latar ikon.',
            'color.string' => 'Format warna tidak valid.',
        ]
    );

        $konten = $request->konten;

        // Jika ada gambar sementara, pindahkan ke folder permanen
        if ($request->filled('temp_images')) {
            $tempImages = explode(',', $request->temp_images);
            
            foreach ($tempImages as $tempImageUrl) {
                if (!empty($tempImageUrl)) {
                    // Ekstrak path dari URL
                    $tempPath = str_replace(asset('storage/'), '', $tempImageUrl);
                    
                    // Cek apakah file ada di folder temp
                    if (Storage::disk('public')->exists($tempPath) && Str::startsWith($tempPath, 'uploads/timeline/temp/')) {
                        // Buat path baru untuk folder permanen
                        $filename = basename($tempPath);
                        $newPath = 'uploads/timeline/' . $filename;
                        
                        // Pindahkan file dari temp ke folder permanen
                        Storage::disk('public')->move($tempPath, $newPath);
                        
                        // Update URL di konten
                        $oldUrl = asset('storage/' . $tempPath);
                        $newUrl = asset('storage/' . $newPath);
                        $konten = str_replace($oldUrl, $newUrl, $konten);
                    }
                }
            }
        }

        // Simpan ke database
        Timeline::create([
            'tanggal' => Carbon::now()->toDateString(), // hasil: '2025-07-03'
            'waktu'   => Carbon::now()->toTimeString(), // hasil: '14:25:30'
            'judul' => $request->judul,
            'konten' => $konten,
            'icon' => $request->icon,
            'color' => $request->color,
        ]);

        // Bersihkan gambar sementara yang tidak digunakan
        $this->cleanupTempImages();

        return redirect()->back()->with('timeline', 'Timeline berhasil disimpan!');
    }

    /**
     * Upload gambar sementara untuk preview
     */
    public function uploadTempImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/timeline/temp', $filename, 'public');

            $url = asset('storage/' . $path);

            return response()->json(['location' => $url]);
        }

        return response()->json(['error' => 'Tidak ada file yang dikirim'], 400);
    }

    /**
     * Upload gambar permanen (untuk backward compatibility)
     */
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/timeline', $filename, 'public');

            $url = asset('storage/' . $path);

            return response()->json(['location' => $url]);
        }

        return response()->json(['error' => 'Tidak ada file yang dikirim'], 400);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $timeline = Timeline::findOrFail($id);
        return view('edit_timeline', compact('timeline'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $timeline = Timeline::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'icon' => 'required|string',
            'color' => 'required|string',
        ], [
            'judul.required' => 'Judul wajib diisi.',
            'judul.max' => 'Judul tidak boleh lebih dari 255 karakter.',
            'konten.required' => 'Isi tidak boleh kosong.',
            'icon.required' => 'Pilih salah satu ikon.',
            'icon.string' => 'Format ikon tidak valid.',
            'color.required' => 'Pilih salah satu warna latar ikon.',
            'color.string' => 'Format warna tidak valid.',
        ]);

        $konten = $request->konten;

        // Jika ada gambar sementara, pindahkan ke folder permanen
        if ($request->filled('temp_images')) {
            $tempImages = explode(',', $request->temp_images);
            foreach ($tempImages as $tempImageUrl) {
                if (!empty($tempImageUrl)) {
                    $tempPath = str_replace(asset('storage/'), '', $tempImageUrl);
                    if (Storage::disk('public')->exists($tempPath) && Str::startsWith($tempPath, 'uploads/timeline/temp/')) {
                        $filename = basename($tempPath);
                        $newPath = 'uploads/timeline/' . $filename;
                        Storage::disk('public')->move($tempPath, $newPath);
                        $oldUrl = asset('storage/' . $tempPath);
                        $newUrl = asset('storage/' . $newPath);
                        $konten = str_replace($oldUrl, $newUrl, $konten);
                    }
                }
            }
        }

        $timeline->update([
            'judul' => $request->judul,
            'konten' => $konten,
            'icon' => $request->icon,
            'color' => $request->color,
        ]);

        $this->cleanupTempImages();

        return redirect()->route('timeline')->with('timeline', 'Timeline berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $timeline = Timeline::findOrFail($id);


        // Regex cari semua src gambar dari konten
        preg_match_all('/<img[^>]+src="([^">]+)"/', $timeline->konten, $matches); 
        // $matches[1] adalah array src gambar contoh: https://yourdomain.com/storage/uploads/timeline/abc.jpg
        // sedangkan $matches[0] adalah array semua string dengan contoh: <img src="https://yourdomain.com/storage/uploads/timeline/abc.jpg">

        if (!empty($matches[1])) {
            foreach ($matches[1] as $url) {
                // Hilangkan domain (misal: http://localhost/storage/uploads/xxx.jpg → uploads/xxx.jpg)
                $path = str_replace(asset('storage') . '/', '', $url);

                // Cek file dan hapus
                // if (Storage::disk('public')->exists($path)) {
                //     Storage::disk('public')->delete($path);
                // }
                if (Str::startsWith($path, 'uploads/timeline/')) {
                    if (Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                    }
                }
            }
        }

        // Hapus timeline dari database
        $timeline->delete();

        return redirect()->back()->with('status', 'Timeline & gambar berhasil dihapus.');
    }

    /**
     * Membersihkan gambar sementara yang tidak digunakan
     */
    public function cleanupTempImages()
    {
        $tempPath = 'uploads/timeline/temp';
        
        if (Storage::disk('public')->exists($tempPath)) {
            $files = Storage::disk('public')->files($tempPath);
            
            foreach ($files as $file) {
                // Hapus file yang lebih dari 5 menit
                $fileTime = Storage::disk('public')->lastModified($file);
                if (time() - $fileTime > 300) { // 5 menit = 300 detik
                    Storage::disk('public')->delete($file);
                }
            }
        }
    }

    /**
     * Membersihkan gambar sementara yang spesifik
     */
    public function cleanupSpecificTempImages(Request $request)
    {
        if ($request->filled('temp_images')) {
            $tempImages = explode(',', $request->temp_images);
            
            foreach ($tempImages as $tempImageUrl) {
                if (!empty($tempImageUrl)) {
                    // Ekstrak path dari URL
                    $tempPath = str_replace(asset('storage/'), '', $tempImageUrl);
                    
                    // Hapus file jika ada di folder temp
                    if (Storage::disk('public')->exists($tempPath) && Str::startsWith($tempPath, 'uploads/timeline/temp/')) {
                        Storage::disk('public')->delete($tempPath);
                    }
                }
            }
        }
        
        return response()->json(['success' => true]);
    }
}

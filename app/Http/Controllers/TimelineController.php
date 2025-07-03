<?php

namespace App\Http\Controllers;

use App\Models\Timeline;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timelines = Timeline::all();

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

        // Simpan ke database
        Timeline::create([
            'tanggal' => Carbon::now()->toDateString(), // hasil: '2025-07-03'
            'waktu'   => Carbon::now()->toTimeString(), // hasil: '14:25:30'
            'judul' => $request->judul,
            'konten' => $request->konten,
            'icon' => $request->icon,
            'color' => $request->color,
        ]);

        return redirect()->back()->with('timeline', 'Timeline berhasil disimpan!');
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

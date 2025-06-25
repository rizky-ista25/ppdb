<?php

namespace App\Http\Controllers;

use App\Models\DokumenWali;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function formPribadi()
    {
        $id = Auth::user()->id; 
        $siswa = Siswa::where('user_id',$id)->first();
        $status = $siswa->status_dok_siswa;
        return view('formulir.siswa', compact('siswa', 'status'));
        // dd($id);
    }
    public function formAyah()
    {
        $id = Auth::user()->id; 
        $ortu = DokumenWali::where('siswa_id',$id)->first();
        $status = $ortu->status_dok_ortu;
        return view('formulir.ortu',compact(
            'ortu',
            'status'
        ));
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

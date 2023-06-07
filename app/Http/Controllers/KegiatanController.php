<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.kegiatan.index', [
            'title' => 'Daftar Kegiatan',
            'kegiatans' => Kegiatan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.kegiatan.create', [
            'title' => 'Tambah Kegiatan',
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'tempat' => 'required',
            'tanggal' => 'required',
        ]);
        
        $validatedData['slug'] = SlugService::createSlug(Kegiatan::class, 'slug', $request->nama);
        $validatedData['user_id'] = auth()->user()->id;

        Kegiatan::create($validatedData);
        return redirect('/dashboard/kegiatans')->with('success', 'Kegiatan berhasil ditambahkan!'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Kegiatan $kegiatan)
    {
        return view('dashboard.kegiatan.show', [
            'title' => 'Rincian Kegiatan',
            'kegiatan' => $kegiatan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kegiatan $kegiatan)
    {
        return redirect('/dashboard/kegiatans');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'tempat' => 'required',
            'tanggal' => 'required',
        ]);
        
        $validatedData['slug'] = SlugService::createSlug(Kegiatan::class, 'slug', $request->nama);
        $validatedData['user_id'] = auth()->user()->id;

        Kegiatan::where('id', $kegiatan->id)->update($validatedData);
        return redirect('/dashboard/kegiatans')->with('success', 'Kegiatan berhasil ditambahkan!'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        Kegiatan::destroy($kegiatan->id);
        return redirect('/dashboard/kegiatans')->with('success', 'kegiatan berhasil dihapus!');
    }
}

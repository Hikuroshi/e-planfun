<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.anggaran.index', [
            'title' => 'Daftar Anggaran',
            'anggarans' => Anggaran::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.anggaran.create', [
            'title' => 'Tambah Anggaran',
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'keperluan' => 'required',
            'jumlah' => 'required',
        ]);
        
        $validatedData['slug'] = SlugService::createSlug(Anggaran::class, 'slug', $request->keperluan);
        $validatedData['user_id'] = auth()->user()->id;

        Anggaran::create($validatedData);
        return redirect('/dashboard/anggarans')->with('success', 'Anggaran berhasil ditambahkan!'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Anggaran $anggaran)
    {
        return view('dashboard.anggaran.show', [
            'title' => 'Rincian Anggaran',
            'anggaran' => $anggaran,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anggaran $anggaran)
    {
        return view('dashboard.anggaran.edit', [
            'title' => 'Perbarui Anggaran',
            'anggaran' => $anggaran,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anggaran $anggaran)
    {
        $validatedData = $request->validate([
            'keperluan' => 'required',
            'jumlah' => 'required',
        ]);
        
        $validatedData['slug'] = SlugService::createSlug(Anggaran::class, 'slug', $request->keperluan);
        $validatedData['user_id'] = auth()->user()->id;

        Anggaran::where('id', $anggaran->id)->update($validatedData);
        return redirect('/dashboard/anggarans')->with('success', 'Anggaran berhasil ditambahkan!'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anggaran $anggaran)
    {
        Anggaran::destroy($anggaran->id);
        return redirect('/dashboard/anggarans')->with('success', 'anggaran berhasil dihapus!');
    }
}

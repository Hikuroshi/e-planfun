<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.barang.index', [
            'title' => 'Daftar Barang',
            'barangs' => Barang::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.barang.create', [
            'title' => 'Tambah Barang',
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'merek' => 'required',
            'harga' => 'required',
        ]);
        
        $validatedData['slug'] = SlugService::createSlug(Barang::class, 'slug', $request->nama);
        $validatedData['user_id'] = auth()->user()->id;

        Barang::create($validatedData);
        return redirect('/dashboard/barangs')->with('success', 'Barang berhasil ditambahkan!'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        return redirect('/dashboard/barangs');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return view('dashboard.barang.edit', [
            'title' => 'Perbarui Barang',
            'barang' => $barang,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'merek' => 'required',
            'harga' => 'required',
        ]);
        
        $validatedData['slug'] = SlugService::createSlug(Barang::class, 'slug', $request->nama);
        $validatedData['user_id'] = auth()->user()->id;

        Barang::where('id', $barang->id)->update($validatedData);
        return redirect('/dashboard/barangs')->with('success', 'Barang berhasil ditambahkan!'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        Barang::destroy($barang->id);
        return redirect('/dashboard/barangs')->with('success', 'barang berhasil dihapus!');
    }
}

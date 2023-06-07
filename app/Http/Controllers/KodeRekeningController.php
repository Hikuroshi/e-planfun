<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Barang;
use App\Models\Kegiatan;
use App\Models\KodeRekening;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class KodeRekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.kode-rekening.index', [
            'title' => 'Daftar Kode Rekening',
            'kodeRekenings' => KodeRekening::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.kode-rekening.create', [
            'title' => 'Tambah Kode Rekening',
            'kegiatans' => Kegiatan::all(),
            'barangs' => Barang::all(),
            'anggarans' => Anggaran::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kegiatan_id' => 'required',
            'barang_id' => 'required',
            'anggaran_id' => 'required',
            'uraian' => 'required',
        ]);

        $barang_kode = implode('.', $request->barang_id);
        $validatedData['kode'] = $request->kegiatan_id .'.'. $barang_kode .'.'. $request->anggaran_id . '.';
        $validatedData['slug'] = SlugService::createSlug(KodeRekening::class, 'slug', $request->uraian);
        $validatedData['user_id'] = auth()->user()->id;
        
        $kodeRekening = KodeRekening::create($validatedData);

        foreach ($request->barang_id as $barangId) {
            $kodeRekening->barangs()->attach($barangId);
        }
        return redirect('/dashboard/kode-rekenings')->with('success', 'Kode Rekening berhasil ditambahkan!'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(KodeRekening $kodeRekening)
    {
        return redirect('/dashboard/kode-rekenings');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KodeRekening $kodeRekening)
    {
        return view('dashboard.kode-rekening.edit', [
            'title' => 'Perbarui Kode Rekening',
            'kodeRekening' => $kodeRekening,
            'kegiatans' => Kegiatan::all(),
            'barangs' => Barang::all(),
            'anggarans' => Anggaran::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KodeRekening $kodeRekening)
    {
        $validatedData = $request->validate([
            'kegiatan_id' => 'required',
            'barang_id' => 'required|array',
            'anggaran_id' => 'required',
            'uraian' => 'required',
        ]);
    
        $barang_kode = implode('.', $request->barang_id);
        $validatedData['kode'] = $request->kegiatan_id .'.'. $barang_kode .'.'. $request->anggaran_id . '.';
        $validatedData['slug'] = SlugService::createSlug(KodeRekening::class, 'slug', $request->uraian);
        $validatedData['user_id'] = auth()->user()->id;
        
        $kodeRekening->update($validatedData);
        $kodeRekening->barangs()->detach();
    
        foreach ($request->barang_id as $barangId) {
            $kodeRekening->barangs()->attach($barangId);
        }
        
        return redirect('/dashboard/kode-rekenings')->with('success', 'Kode Rekening berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KodeRekening $kodeRekening)
    {
        KodeRekening::destroy($kodeRekening->id);
        return redirect('/dashboard/kode-rekenings')->with('success', 'Kode Rekening berhasil dihapus!');
    }
}

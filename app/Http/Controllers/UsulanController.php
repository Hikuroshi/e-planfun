<?php

namespace App\Http\Controllers;

use App\Models\KodeRekening;
use App\Models\Usulan;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class UsulanController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        return view('dashboard.usulan.index', [
            'title' => 'Daftar Usulan',
            'usulans' => Usulan::all(),
        ]);
    }
    
    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {
        if (! Gate::allows('operator')) {
            abort(401);
        }

        return view('dashboard.usulan.create', [
            'title' => 'Input Usulan',
            'kode_rekenings' => KodeRekening::all(),
        ]);
    }
    
    /**
    * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_rekening_id' => 'required',
            'keterangan' => 'required',
            'data_pendukung' => 'required|mimes:pdf|file|max:10000'
        ]);
        
        $validatedData['slug'] = SlugService::createSlug(Usulan::class, 'slug', $request->keterangan);
        $validatedData['data_pendukung'] = $request->file('data_pendukung')->store('data-pendukung');
        $validatedData['status'] = auth()->user()->role->slug;
        $validatedData['status_verifikasi'] = 'Disetujui';
        $validatedData['user_id'] = auth()->user()->id;
        
        Usulan::create($validatedData);
        return redirect('/dashboard/usulans')->with('success', 'Usulan berhasil ditambahkan!');
    }
    
    /**
    * Display the specified resource.
    */
    public function show(Usulan $usulan)
    {
        if (! Gate::allows('operator')) {
            abort(401);
        }

        return view('dashboard.usulan.show', [
            'title' => 'Rincian Usulan',
            'usulan' => $usulan,
        ]);
    }
    
    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Usulan $usulan)
    {
        if (! Gate::allows('operator')) {
            abort(401);
        }

        return view('dashboard.usulan.edit', [
            'title' => 'Perbarui Usulan',
            'usulan' => $usulan,
            'kode_rekenings' => KodeRekening::all(),
        ]);
    }
    
    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, Usulan $usulan)
    {
        $validatedData = $request->validate([
            'kode_rekening_id' => 'required',
            'keterangan' => 'required',
            'data_pendukung' => 'mimes:pdf|file|max:10000'
        ]);
        
        if ($request->file('data_pendukung')) {
            if($request->old_data_pendukung){
                Storage::delete($request->old_data_pendukung);
            }
            $validatedData['data_pendukung'] = $request->file('data_pendukung')->store('data-pendukung');
        }
        
        $validatedData['slug'] = SlugService::createSlug(Usulan::class, 'slug', $request->keterangan);
        $validatedData['status'] = auth()->user()->role->slug;
        $validatedData['status_verifikasi'] = 'Disetujui';
        $validatedData['user_id'] = auth()->user()->id;
        
        Usulan::where('id', $usulan->id)->update($validatedData);
        return redirect('/dashboard/usulans')->with('success', 'Usulan berhasil diperbarui!');
    }
    
    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Usulan $usulan)
    {
        if ($usulan->data_pendukung) {
            Storage::delete($usulan->data_pendukung);
        }
        Usulan::destroy($usulan->id);
        return redirect('/dashboard/usulans')->with('success', 'Usulan berhasil dihapus!');
    }
}

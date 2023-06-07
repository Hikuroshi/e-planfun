<?php

namespace App\Http\Controllers;

use App\Models\Usulan;
use Illuminate\Http\Request;

class VerifikasiUsulanController extends Controller
{
    public function index()
    {
        $usulans = collect();
    
        switch (auth()->user()->role->slug) {
            case 'kasubag-perencanaan':
                $usulans = Usulan::whereIn('status', ['subbag-tu-rungga', 'subag-humas-protokol'])
                    ->where('status_verifikasi', 'Disetujui')
                    ->orWhere(function ($query) {
                        $query->where('status', 'kasubag-perencanaan')
                            ->where('status_verifikasi', 'Ditolak');
                    })->get();
                break;
            case 'kepala-kantor':
                $usulans = Usulan::where('status', 'kasubag-perencanaan')
                    ->where('status_verifikasi', 'Disetujui')
                    ->orWhere(function ($query) {
                        $query->where('status', 'kepala-kantor')
                            ->where('status_verifikasi', 'Ditolak');
                    })->get();
                break;
            case 'pejabat-pembuat-komitmen':
                $usulans = Usulan::where('status', 'kepala-kantor')
                    ->where('status_verifikasi', 'Disetujui')
                    ->orWhere(function ($query) {
                        $query->where('status', 'pejabat-pembuat-komitmen')
                            ->where('status_verifikasi', 'Ditolak');
                    })->get();
                break;
            case 'sekjen':
                $usulans = Usulan::where('status', 'pejabat-pembuat-komitmen')
                    ->where('status_verifikasi', 'Disetujui')->get();
                break;
        }
    
        return view('dashboard.verifikasi-usulan.index', [
            'title' => 'Verifikasi Usulan',
            'usulans' => $usulans
        ]);
    }
        
    public function edit(Usulan $usulan)
    {
        return view('dashboard.verifikasi-usulan.update', [
            'title' => 'Verifikasi Usulan',
            'usulan' => $usulan,
        ]);
    }
    
    public function update(Request $request, Usulan $usulan)
    {
        $validatedData = $request->validate([
            'status_verifikasi' => 'required',
            'keterangan_verifikasi' => 'required'
        ]);
        
        if ($request->status_verifikasi == 'Disetujui') {
            $validatedData['status'] = auth()->user()->role->slug;
        } elseif ($request->status_verifikasi == 'Ditolak') {
            if (auth()->user()->role->slug == 'kasubag-perencanaan'){
                $validatedData['status'] = $usulan->user->role->slug;
            } elseif (auth()->user()->role->slug == 'kepala-kantor'){
                $validatedData['status'] = 'kasubag-perencanaan';
            } elseif (auth()->user()->role->slug == 'pejabat-pembuat-komitmen'){
                $validatedData['status'] = 'kepala-kantor';
            } elseif (auth()->user()->role->slug == 'sekjen'){
                $validatedData['status'] = 'pejabat-pembuat-komitmen';
            }
        }
        
        $usulan->update($validatedData);
        return redirect('/dashboard/verifikasi-usulan')->with('success', 'verifikasi has been updated!');
    }
}

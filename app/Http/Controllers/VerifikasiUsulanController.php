<?php

namespace App\Http\Controllers;

use App\Models\Usulan;
use Illuminate\Http\Request;

class VerifikasiUsulanController extends Controller
{
    public function index()
    {
        if(auth()->user()->role->slug == 'subbag-tu-rungga' || auth()->user()->role->slug == 'subag-humas-protokol'){
            $usulans = Usulan::all();
        } elseif (auth()->user()->role->slug == 'kasubag-perencanaan'){
            $usulans = Usulan::where('status', 'subbag-tu-rungga')->orWhere('status', 'subag-humas-protokol')->get();
        } elseif (auth()->user()->role->slug == 'kepala-kantor'){
            $usulans = Usulan::where('status', 'kasubag-perencanaan')->get();
        } elseif (auth()->user()->role->slug == 'pejabat-pembuat-komitmen'){
            $usulans = Usulan::where('status', 'kepala-kantor')->get();
        } elseif (auth()->user()->role->slug == 'sekjen'){
            $usulans = Usulan::where('status', 'pejabat-pembuat-komitmen')->get();
        }

        return view('dashboard.verifikasi-usulan.index', [
            'title' => 'Verifikasi Usulan',
            'usulans' => $usulans->where('status_verifikasi', 'Disetujui')
        ]);
    }

    public function edit(Usulan $usulan)
    {
        $verif = '';
        
        if ($usulan->status == 'subbag-tu-rungga' || $usulan->status == 'subag-humas-protokol') {
            if ($usulan->status_verifikasi == 'Disetujui') {
                $verif = 'Sedang diusulkan ke KASUBAG PERENCANAAN';
            } else {
                $verif = 'Ditolak oleh KASUBAG PERENCANAAN';
            }
        } elseif ($usulan->status == 'kasubag-perencanaan') {
            if ($usulan->status_verifikasi == 'Disetujui') {
                $verif = 'Telah diverifikasi oleh ' . $usulan->aktor->nama . ' dan sedang diusulkan ke KEPALA KANTOR';
            } else {
                $verif = 'Ditolak oleh KEPALA KANTOR';
            }
        } elseif ($usulan->status == 'kepala-kantor') {
            if ($usulan->status_verifikasi == 'Disetujui') {
                $verif = 'Telah diverifikasi oleh ' . $usulan->aktor->nama . ' dan sedang diusulkan ke PEJABAT PEMBUAT KOMITMEN';
            } else {
                $verif = 'Ditolak oleh PEJABAT PEMBUAT KOMITMEN';
            }
        } elseif ($usulan->status == 'pejabat-pembuat-komitmen') {
            if ($usulan->status_verifikasi == 'Disetujui') {
                $verif = 'Telah diverifikasi oleh ' . $usulan->aktor->nama . ' dan sedang diusulkan ke KABAG PERENCANAAN';
            } else {
                $verif = 'Ditolak oleh PEJABAT KABAG PERENCANAAN';
            }
        } elseif ($usulan->status == 'kabag-perencanaan') {
            if ($usulan->status_verifikasi == 'Disetujui') {
                $verif = 'Telah diverifikasi oleh ' . $usulan->aktor->nama . ' dan sedang diusulkan ke SEKJEN';
            } else {
                $verif = 'Ditolak oleh SEKJEN';
            }
        } elseif ($usulan->status == 'sekjen') {
            if ($usulan->status_verifikasi == 'Disetujui') {
                $verif = 'Telah diverifikasi oleh ' . $usulan->aktor->nama;
            }
        }
        
        return view('dashboard.verifikasi-usulan.update', [
            'title' => 'Verifikasi Usulan',
            'usulan' => $usulan,
            'verif' => $verif
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

        Usulan::where('id', $usulan->id)->update($validatedData);
        return redirect('/dashboard/verifikasi-usulan')->with('success', 'verifikasi has been updated!');
    }
}

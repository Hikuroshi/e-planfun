<?php

namespace App\Http\Controllers;

use App\Models\Usulan;
use Illuminate\Http\Request;

class VerifikasiUsulanController extends Controller
{
    public function index()
    {
        $usulans = null;

        if (auth()->user()->role->slug == 'subbag-tu-rungga' || auth()->user()->role->slug == 'subag-humas-protokol') {
            $usulans = Usulan::all();
        } elseif (auth()->user()->role->slug == 'kasubag-perencanaan') {
            $usulans = Usulan::whereIn('status', ['subbag-tu-rungga', 'subag-humas-protokol'])->get();
        } elseif (auth()->user()->role->slug == 'kepala-kantor') {
            $usulans = Usulan::where('status', 'kasubag-perencanaan')->get();
        } elseif (auth()->user()->role->slug == 'pejabat-pembuat-komitmen') {
            $usulans = Usulan::where('status', 'kepala-kantor')->get();
        } elseif (auth()->user()->role->slug == 'sekjen') {
            $usulans = Usulan::where('status', 'pejabat-pembuat-komitmen')->get();
        }

        if ($usulans !== null) {
            $usulans = $usulans->where('status_verifikasi', 'Disetujui')->values();
        } else {
            $usulans = collect();
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
            $roles = [
                'kasubag-perencanaan' => 'subbag-tu-rungga',
                'kepala-kantor' => 'kasubag-perencanaan',
                'pejabat-pembuat-komitmen' => 'kepala-kantor',
                'sekjen' => 'pejabat-pembuat-komitmen'
            ];

            $validatedData['status'] = $roles[auth()->user()->role->slug];
        }

        // if ($request->status_verifikasi == 'Disetujui') {
        //     $validatedData['status'] = auth()->user()->role->slug;
        // } elseif ($request->status_verifikasi == 'Ditolak') {
        //     if (auth()->user()->role->slug == 'kasubag-perencanaan'){
        //         $validatedData['status'] = $usulan->user->role->slug;
        //     } elseif (auth()->user()->role->slug == 'kepala-kantor'){
        //         $validatedData['status'] = 'kasubag-perencanaan';
        //     } elseif (auth()->user()->role->slug == 'pejabat-pembuat-komitmen'){
        //         $validatedData['status'] = 'kepala-kantor';
        //     } elseif (auth()->user()->role->slug == 'sekjen'){
        //         $validatedData['status'] = 'pejabat-pembuat-komitmen';
        //     }
        // }

        $usulan->update($validatedData);
        return redirect('/dashboard/verifikasi-usulan')->with('success', 'verifikasi has been updated!');
    }
}

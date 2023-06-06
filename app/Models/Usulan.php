<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Usulan extends Model
{
    use HasFactory, Sluggable;
    
    protected $guarded = ['id'];
    protected $with = ['user', 'aktor', 'kodeRekening'];
    
    public function getVerifikasiAttribute()
    {
        if ($this->status == 'subbag-tu-rungga' || $this->status == 'subag-humas-protokol') {
            if ($this->status_verifikasi == 'Disetujui') {
                return 'Sedang diusulkan ke KASUBAG PERENCANAAN';
            } else {
                return 'Ditolak oleh KASUBAG PERENCANAAN';
            }
        } elseif ($this->status == 'kasubag-perencanaan') {
            if ($this->status_verifikasi == 'Disetujui') {
                return 'Telah diverifikasi oleh ' . $this->aktor->nama . ' dan sedang diusulkan ke KEPALA KANTOR';
            } else {
                return 'Ditolak oleh KEPALA KANTOR';
            }
        } elseif ($this->status == 'kepala-kantor') {
            if ($this->status_verifikasi == 'Disetujui') {
                return 'Telah diverifikasi oleh ' . $this->aktor->nama . ' dan sedang diusulkan ke PEJABAT PEMBUAT KOMITMEN';
            } else {
                return 'Ditolak oleh PEJABAT PEMBUAT KOMITMEN';
            }
        } elseif ($this->status == 'pejabat-pembuat-komitmen') {
            if ($this->status_verifikasi == 'Disetujui') {
                return 'Telah diverifikasi oleh ' . $this->aktor->nama . ' dan sedang diusulkan ke KABAG PERENCANAAN';
            } else {
                return 'Ditolak oleh PEJABAT KABAG PERENCANAAN';
            }
        } elseif ($this->status == 'kabag-perencanaan') {
            if ($this->status_verifikasi == 'Disetujui') {
                return 'Telah diverifikasi oleh ' . $this->aktor->nama . ' dan sedang diusulkan ke SEKJEN';
            } else {
                return 'Ditolak oleh SEKJEN';
            }
        } elseif ($this->status == 'sekjen') {
            if ($this->status_verifikasi == 'Disetujui') {
                return 'Telah diverifikasi oleh ' . $this->aktor->nama;
            }
        }
        
        return '';
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function aktor()
    {
        return $this->belongsTo(Role::class, 'status', 'slug');
    }
    
    public function kodeRekening()
    {
        return $this->belongsTo(KodeRekening::class, 'kode_rekening_id');
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'keterangan'
                ]
            ];
        }
    }
    
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];
    protected $with = ['role'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function usulans()
    {
        return $this->hasMany(Usulan::class, 'usulan_id');
    }

    public function kode_rekenings()
    {
        return $this->hasMany(KodeRekening::class, 'kode_rekening_id');
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class, 'kegiatan_id');
    }

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'barang_id');
    }

    public function anggarans()
    {
        return $this->hasMany(Anggaran::class, 'anggaran_id');
    }

    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}

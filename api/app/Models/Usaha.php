<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usaha extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'usaha';

    protected $fillable = [
        'nama_usaha',
        'nama_pemilik',
        'email',
        'password',
        'telepon',
        'alamat',
        'logo',
        'warna_primer',
        'warna_sekunder',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'usaha_id');
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'usaha_id');
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }
}

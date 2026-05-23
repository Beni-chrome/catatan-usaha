<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsahaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,

            'nama_usaha' => $this->nama_usaha,

            'nama_pemilik' => $this->nama_pemilik,

            'email' => $this->email,

            'telepon' => $this->telepon,

            'alamat' => $this->alamat,

            'logo' => $this->logo,

            'warna_primer' => $this->warna_primer,

            'warna_sekunder' => $this->warna_sekunder,

            'role' => $this->role,
        ];
    }
}

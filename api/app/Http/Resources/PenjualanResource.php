<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PenjualanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,

            'tanggal' => $this->tanggal,

            'jumlah' => $this->jumlah,

            'harga_jual' => $this->harga_jual,

            'total' => $this->total,

            'keterangan' => $this->keterangan,

            'produk' => [
                'id' => $this->produk?->id,
                'nama' => $this->produk?->nama,
            ],
        ];
    }
}

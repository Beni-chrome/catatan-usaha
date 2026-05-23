<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdukResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,

            'nama' => $this->nama,

            'satuan' => $this->satuan,

            'harga' => $this->harga,
        ];
    }
}

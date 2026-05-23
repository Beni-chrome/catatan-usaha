<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenjualanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'tanggal' => 'required|date',

            'produk_id' => 'required|exists:produk,id',

            'jumlah' => 'required|numeric|min:0',

            'harga_jual' => 'required|numeric|min:0',

            'total' => 'required|numeric|min:0',

            'keterangan' => 'nullable',
        ];
    }
}

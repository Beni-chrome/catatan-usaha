<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|max:100',
            'satuan' => 'required|max:20',
            'harga' => 'required|numeric|min:0',
        ];
    }
}


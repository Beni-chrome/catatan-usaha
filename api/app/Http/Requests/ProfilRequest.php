<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'nama_usaha' => 'required|max:100',

            'nama_pemilik' => 'required|max:100',

            'telepon' => 'required|max:20',

            'alamat' => 'required',

            'warna_primer' => 'required|max:7',

            'warna_sekunder' => 'required|max:7',
        ];
    }
}

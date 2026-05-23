<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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

            'email' => 'required|email|unique:usaha,email',

            'password' => 'required|min:6',

            'telepon' => 'required|max:20',

            'alamat' => 'required',

            'warna_primer' => 'required|max:7',

            'warna_sekunder' => 'required|max:7',

            'logo' => 'nullable|image|max:2048',
        ];
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UsahaResource;
use App\Models\Usaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logo-usaha', 'public');
        }

        $usaha = Usaha::create([
            'nama_usaha' => $data['nama_usaha'],
            'nama_pemilik' => $data['nama_pemilik'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'telepon' => $data['telepon'],
            'alamat' => $data['alamat'],
            'logo' => $logoPath,
            'warna_primer' => $data['warna_primer'],
            'warna_sekunder' => $data['warna_sekunder'],
            'role' => 'usaha',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registrasi usaha berhasil',
            'data' => new UsahaResource($usaha),
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $usaha = Usaha::where('email', $request->email)->first();

        if (!$usaha || !Hash::check($request->password, $usaha->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah'],
            ]);
        }

        $token = $usaha->createToken('catatan-usaha-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'token' => $token,
                'usaha' => new UsahaResource($usaha),
            ],
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
            'data' => null,
        ]);
    }

    public function profil(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data profil',
            'data' => new UsahaResource($request->user()),
        ]);
    }
}

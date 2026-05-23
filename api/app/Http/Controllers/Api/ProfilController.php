<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilRequest;
use App\Http\Resources\UsahaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function show(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data profil',
            'data' => new UsahaResource($request->user()),
        ]);
    }

    public function update(ProfilRequest $request)
    {
        $usaha = $request->user();

        $usaha->update([
            'nama_usaha' => $request->nama_usaha,
            'nama_pemilik' => $request->nama_pemilik,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'warna_primer' => $request->warna_primer,
            'warna_sekunder' => $request->warna_sekunder,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui',
            'data' => new UsahaResource($usaha),
        ]);
    }

    public function uploadLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|max:2048',
        ]);

        $usaha = $request->user();

        if ($usaha->logo && Storage::disk('public')->exists($usaha->logo)) {
            Storage::disk('public')->delete($usaha->logo);
        }

        $path = $request->file('logo')->store('logo-usaha', 'public');

        $usaha->update([
            'logo' => $path,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Logo berhasil diperbarui',
            'data' => new UsahaResource($usaha),
        ]);
    }
}

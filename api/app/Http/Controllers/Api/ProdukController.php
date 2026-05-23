<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukRequest;
use App\Http\Resources\ProdukResource;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $produk = Produk::where('usaha_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data produk',
            'data' => ProdukResource::collection($produk),
        ]);
    }

    public function store(ProdukRequest $request)
    {
        $produk = Produk::create([
            'usaha_id' => $request->user()->id,
            'nama' => $request->nama,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan',
            'data' => new ProdukResource($produk),
        ], 201);
    }

    public function update(ProdukRequest $request, $id)
    {
        $produk = Produk::where('usaha_id', $request->user()->id)
            ->where('id', $id)
            ->firstOrFail();

        $produk->update([
            'nama' => $request->nama,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil diperbarui',
            'data' => new ProdukResource($produk),
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $produk = Produk::where('usaha_id', $request->user()->id)
            ->where('id', $id)
            ->firstOrFail();

        $produk->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus',
            'data' => null,
        ]);
    }
}

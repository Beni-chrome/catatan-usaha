<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenjualanRequest;
use App\Http\Resources\PenjualanResource;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penjualan::with('produk')
            ->where('usaha_id', $request->user()->id);

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->filled('dari') && $request->filled('sampai')) {
            $query->whereBetween('tanggal', [
                $request->dari,
                $request->sampai
            ]);
        }

        $penjualan = $query->latest('tanggal')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data penjualan',
            'data' => PenjualanResource::collection($penjualan),
        ]);
    }

    public function store(PenjualanRequest $request)
    {
        $produk = Produk::where('usaha_id', $request->user()->id)
            ->where('id', $request->produk_id)
            ->firstOrFail();

        $total = $request->jumlah * $request->harga_jual;

        $penjualan = Penjualan::create([
            'usaha_id' => $request->user()->id,
            'tanggal' => $request->tanggal,
            'produk_id' => $produk->id,
            'jumlah' => $request->jumlah,
            'harga_jual' => $request->harga_jual,
            'total' => $total,
            'keterangan' => $request->keterangan,
        ]);

        $penjualan->load('produk');

        return response()->json([
            'success' => true,
            'message' => 'Penjualan berhasil ditambahkan',
            'data' => new PenjualanResource($penjualan),
        ], 201);
    }

    public function update(PenjualanRequest $request, $id)
    {
        $penjualan = Penjualan::where('usaha_id', $request->user()->id)
            ->where('id', $id)
            ->firstOrFail();

        $produk = Produk::where('usaha_id', $request->user()->id)
            ->where('id', $request->produk_id)
            ->firstOrFail();

        $total = $request->jumlah * $request->harga_jual;

        $penjualan->update([
            'tanggal' => $request->tanggal,
            'produk_id' => $produk->id,
            'jumlah' => $request->jumlah,
            'harga_jual' => $request->harga_jual,
            'total' => $total,
            'keterangan' => $request->keterangan,
        ]);

        $penjualan->load('produk');

        return response()->json([
            'success' => true,
            'message' => 'Penjualan berhasil diperbarui',
            'data' => new PenjualanResource($penjualan),
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $penjualan = Penjualan::where('usaha_id', $request->user()->id)
            ->where('id', $id)
            ->firstOrFail();

        $penjualan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Penjualan berhasil dihapus',
            'data' => null,
        ]);
    }
}

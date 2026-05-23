<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PenjualanResource;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $usahaId = $request->user()->id;
        $hariIni = Carbon::today();

        $totalHariIni = Penjualan::where('usaha_id', $usahaId)
            ->whereDate('tanggal', $hariIni)
            ->sum('total');

        $jumlahTransaksi = Penjualan::where('usaha_id', $usahaId)
            ->whereDate('tanggal', $hariIni)
            ->count();

        $omzetBulanIni = Penjualan::where('usaha_id', $usahaId)
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('total');

        $grafik = Penjualan::select(
                DB::raw('DATE(tanggal) as tanggal'),
                DB::raw('SUM(total) as total')
            )
            ->where('usaha_id', $usahaId)
            ->whereDate('tanggal', '>=', now()->subDays(6)->toDateString())
            ->groupBy(DB::raw('DATE(tanggal)'))
            ->orderBy('tanggal')
            ->get();

        $transaksiTerbaru = Penjualan::with('produk')
            ->where('usaha_id', $usahaId)
            ->latest()
            ->limit(5)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data dashboard',
            'data' => [
                'total_penjualan_hari_ini' => $totalHariIni,
                'jumlah_transaksi_hari_ini' => $jumlahTransaksi,
                'omzet_bulan_ini' => $omzetBulanIni,
                'grafik_7_hari' => $grafik,
                'transaksi_terbaru' => PenjualanResource::collection($transaksiTerbaru),
            ],
        ]);
    }
}

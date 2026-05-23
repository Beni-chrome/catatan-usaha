<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanController extends Controller
{
    public function harian(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
        ]);

        $data = Penjualan::with('produk')
            ->where('usaha_id', $request->user()->id)
            ->whereDate('tanggal', $request->tanggal)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Laporan harian',
            'data' => [
                'tanggal' => $request->tanggal,
                'total' => $data->sum('total'),
                'items' => $data,
            ],
        ]);
    }

    public function bulanan(Request $request)
    {
        $request->validate([
            'bulan' => 'required|numeric|min:1|max:12',
            'tahun' => 'required|numeric|min:2000',
        ]);

        $data = Penjualan::with('produk')
            ->where('usaha_id', $request->user()->id)
            ->whereMonth('tanggal', $request->bulan)
            ->whereYear('tanggal', $request->tahun)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Laporan bulanan',
            'data' => [
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'total' => $data->sum('total'),
                'items' => $data,
            ],
        ]);
    }

    public function exportPdf(Request $request)
    {
        $usaha = $request->user();

        $query = Penjualan::with('produk')
            ->where('usaha_id', $usaha->id);

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->filled('bulan') && $request->filled('tahun')) {
            $query->whereMonth('tanggal', $request->bulan)
                  ->whereYear('tanggal', $request->tahun);
        }

        $data = $query->latest()->get();

        $pdf = Pdf::loadView('pdf.laporan', [
            'usaha' => $usaha,
            'data' => $data,
            'total' => $data->sum('total'),
            'tanggal' => $request->tanggal,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
        ]);

        return $pdf->download('laporan-catatan-usaha.pdf');
    }

    public function exportExcel(Request $request)
    {
        $usaha = $request->user();

        $query = Penjualan::with('produk')
            ->where('usaha_id', $usaha->id);

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->filled('bulan') && $request->filled('tahun')) {
            $query->whereMonth('tanggal', $request->bulan)
                  ->whereYear('tanggal', $request->tahun);
        }

        $data = $query->latest()->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', $usaha->nama_usaha);
        $sheet->setCellValue('A2', $usaha->alamat);
        $sheet->setCellValue('A3', 'Laporan Penjualan');

        $sheet->setCellValue('A5', 'No');
        $sheet->setCellValue('B5', 'Tanggal');
        $sheet->setCellValue('C5', 'Produk');
        $sheet->setCellValue('D5', 'Jumlah');
        $sheet->setCellValue('E5', 'Harga Jual');
        $sheet->setCellValue('F5', 'Total');
        $sheet->setCellValue('G5', 'Keterangan');

        $row = 6;
        $no = 1;

        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $item->tanggal);
            $sheet->setCellValue('C' . $row, $item->produk->nama ?? '-');
            $sheet->setCellValue('D' . $row, $item->jumlah);
            $sheet->setCellValue('E' . $row, $item->harga_jual);
            $sheet->setCellValue('F' . $row, $item->total);
            $sheet->setCellValue('G' . $row, $item->keterangan);
            $row++;
        }

        $sheet->setCellValue('E' . ($row + 1), 'TOTAL');
        $sheet->setCellValue('F' . ($row + 1), $data->sum('total'));

        $writer = new Xlsx($spreadsheet);
        $fileName = 'laporan-catatan-usaha.xlsx';
        $tempFile = storage_path('app/' . $fileName);

        $writer->save($tempFile);

        return response()->download($tempFile)->deleteFileAfterSend(true);
    }
}

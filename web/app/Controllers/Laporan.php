<?php

namespace App\Controllers;

use App\Libraries\ApiClient;

class Laporan extends BaseController
{
    protected ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    public function index()
    {
        $tanggal = $this->request->getGet('tanggal') ?? date('Y-m-d');
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $harian = $this->api->get('laporan/harian', [
            'tanggal' => $tanggal,
        ]);

        $bulanan = $this->api->get('laporan/bulanan', [
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);

        return view('laporan/index', [
            'title' => 'Laporan',
            'tanggal' => $tanggal,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'harian' => $harian['data'] ?? [],
            'bulanan' => $bulanan['data'] ?? [],
        ]);
    }

    public function exportPdf()
    {
        return redirect()->to('/api-download/pdf?' . http_build_query($this->request->getGet()));
    }

    public function exportExcel()
    {
        return redirect()->to('/api-download/excel?' . http_build_query($this->request->getGet()));
    }
}

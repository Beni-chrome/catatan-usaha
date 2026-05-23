<?php

namespace App\Controllers;

use App\Libraries\ApiClient;

class Penjualan extends BaseController
{
    protected ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    public function index()
    {
        $tanggal = $this->request->getGet('tanggal');

        $penjualan = $this->api->get('penjualan', [
            'tanggal' => $tanggal,
        ]);

        $produk = $this->api->get('produk');

        return view('penjualan/index', [
            'title' => 'Penjualan',
            'penjualan' => $penjualan['data'] ?? [],
            'produk' => $produk['data'] ?? [],
            'tanggal' => $tanggal,
        ]);
    }

    public function store()
    {
        $response = $this->api->post('penjualan', [
            'tanggal' => $this->request->getPost('tanggal'),
            'produk_id' => $this->request->getPost('produk_id'),
            'jumlah' => $this->request->getPost('jumlah'),
            'harga_jual' => $this->request->getPost('harga_jual'),
            'total' => $this->request->getPost('total'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/penjualan')
            ->with(($response['success'] ?? false) ? 'success' : 'error', $response['message'] ?? 'Gagal menyimpan penjualan');
    }

    public function update($id)
    {
        $response = $this->api->put('penjualan/' . $id, [
            'tanggal' => $this->request->getPost('tanggal'),
            'produk_id' => $this->request->getPost('produk_id'),
            'jumlah' => $this->request->getPost('jumlah'),
            'harga_jual' => $this->request->getPost('harga_jual'),
            'total' => $this->request->getPost('total'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/penjualan')
            ->with(($response['success'] ?? false) ? 'success' : 'error', $response['message'] ?? 'Gagal mengubah penjualan');
    }

    public function delete($id)
    {
        $response = $this->api->delete('penjualan/' . $id);

        return redirect()->to('/penjualan')
            ->with(($response['success'] ?? false) ? 'success' : 'error', $response['message'] ?? 'Gagal menghapus penjualan');
    }
}

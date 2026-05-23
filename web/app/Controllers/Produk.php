<?php

namespace App\Controllers;

use App\Libraries\ApiClient;

class Produk extends BaseController
{
    protected ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    public function index()
    {
        $response = $this->api->get('produk');

        return view('produk/index', [
            'title' => 'Produk',
            'produk' => $response['data'] ?? [],
        ]);
    }

    public function store()
    {
        $response = $this->api->post('produk', [
            'nama' => $this->request->getPost('nama'),
            'satuan' => $this->request->getPost('satuan'),
            'harga' => $this->request->getPost('harga'),
        ]);

        return redirect()->to('/produk')
            ->with(($response['success'] ?? false) ? 'success' : 'error', $response['message'] ?? 'Gagal menyimpan produk');
    }

    public function update($id)
    {
        $response = $this->api->put('produk/' . $id, [
            'nama' => $this->request->getPost('nama'),
            'satuan' => $this->request->getPost('satuan'),
            'harga' => $this->request->getPost('harga'),
        ]);

        return redirect()->to('/produk')
            ->with(($response['success'] ?? false) ? 'success' : 'error', $response['message'] ?? 'Gagal mengubah produk');
    }

    public function delete($id)
    {
        $response = $this->api->delete('produk/' . $id);

        return redirect()->to('/produk')
            ->with(($response['success'] ?? false) ? 'success' : 'error', $response['message'] ?? 'Gagal menghapus produk');
    }
}

<?php

namespace App\Controllers;

use App\Libraries\ApiClient;

class Profil extends BaseController
{
    protected ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    public function index()
    {
        $response = $this->api->get('profil');

        return view('profil/index', [
            'title' => 'Profil',
            'profil' => $response['data'] ?? session()->get('usaha'),
        ]);
    }

    public function update()
    {
        $response = $this->api->put('profil', [
            'nama_usaha' => $this->request->getPost('nama_usaha'),
            'nama_pemilik' => $this->request->getPost('nama_pemilik'),
            'telepon' => $this->request->getPost('telepon'),
            'alamat' => $this->request->getPost('alamat'),
            'warna_primer' => $this->request->getPost('warna_primer'),
            'warna_sekunder' => $this->request->getPost('warna_sekunder'),
        ]);

        if ($response['success'] ?? false) {
            session()->set('usaha', $response['data']);
        }

        return redirect()->to('/profil')
            ->with(($response['success'] ?? false) ? 'success' : 'error', $response['message'] ?? 'Gagal mengubah profil');
    }

    public function logo()
    {
        $response = $this->api->upload('profil/logo', [], [
            'logo' => $this->request->getFile('logo'),
        ]);

        if ($response['success'] ?? false) {
            session()->set('usaha', $response['data']);
        }

        return redirect()->to('/profil')
            ->with(($response['success'] ?? false) ? 'success' : 'error', $response['message'] ?? 'Gagal upload logo');
    }
}

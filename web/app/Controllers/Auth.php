<?php

namespace App\Controllers;

use App\Libraries\ApiClient;

class Auth extends BaseController
{
    protected ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginProcess()
    {
        $response = $this->api->post('login', [
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ]);

        if (!($response['success'] ?? false)) {
            return redirect()->back()->with('error', $response['message'] ?? 'Login gagal');
        }

        session()->set([
            'token' => $response['data']['token'],
            'usaha' => $response['data']['usaha'],
        ]);

        return redirect()->to('/dashboard');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerProcess()
    {
        $response = $this->api->upload('register', [
            'nama_usaha' => $this->request->getPost('nama_usaha'),
            'nama_pemilik' => $this->request->getPost('nama_pemilik'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'telepon' => $this->request->getPost('telepon'),
            'alamat' => $this->request->getPost('alamat'),
            'warna_primer' => $this->request->getPost('warna_primer'),
            'warna_sekunder' => $this->request->getPost('warna_sekunder'),
        ], [
            'logo' => $this->request->getFile('logo'),
        ]);

        if (!($response['success'] ?? false)) {
            return redirect()->back()->with('error', $response['message'] ?? 'Registrasi gagal');
        }

        return redirect()->to('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function logout()
    {
        $this->api->post('logout');
        session()->destroy();

        return redirect()->to('/login');
    }
}

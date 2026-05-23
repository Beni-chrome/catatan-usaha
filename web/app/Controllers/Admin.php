<?php

namespace App\Controllers;

use App\Libraries\ApiClient;

class Admin extends BaseController
{
    protected ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    public function index()
    {
        $response = $this->api->get('admin/usaha');

        return view('admin/index', [
            'title' => 'Super Admin',
            'usaha' => $response['data'] ?? [],
        ]);
    }

    public function delete($id)
    {
        $response = $this->api->delete('admin/usaha/' . $id);

        return redirect()->to('/admin/usaha')
            ->with(($response['success'] ?? false) ? 'success' : 'error', $response['message'] ?? 'Gagal menghapus usaha');
    }
}

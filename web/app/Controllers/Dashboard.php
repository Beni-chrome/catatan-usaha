<?php

namespace App\Controllers;

use App\Libraries\ApiClient;

class Dashboard extends BaseController
{
    protected ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    public function index()
    {
        $response = $this->api->get('dashboard');

        return view('dashboard/index', [
            'title' => 'Dashboard',
            'data' => $response['data'] ?? [],
        ]);
    }
}

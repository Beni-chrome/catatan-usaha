<?php

namespace App\Controllers;

use App\Libraries\ApiClient;

class TestApi extends BaseController
{
    public function index()
    {
        $api = new ApiClient();

        $response = $api->post('login', [
            'email' => 'beniusaha@gmail.com',
            'password' => 'password123',
        ]);

        return $this->response->setJSON($response);
    }
}

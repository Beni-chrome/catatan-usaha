<?php

namespace App\Controllers;

use App\Libraries\ApiClient;

class ApiDownload extends BaseController
{
    protected ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    public function pdf()
    {
        $file = $this->api->download('laporan/export-pdf', $this->request->getGet());

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="laporan-catatan-usaha.pdf"')
            ->setBody($file['raw'] ?? '');
    }

    public function excel()
    {
        $file = $this->api->download('laporan/export-excel', $this->request->getGet());

        return $this->response
            ->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            ->setHeader('Content-Disposition', 'attachment; filename="laporan-catatan-usaha.xlsx"')
            ->setBody($file['raw'] ?? '');
    }
}

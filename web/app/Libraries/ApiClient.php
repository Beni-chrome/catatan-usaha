<?php

namespace App\Libraries;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiClient
{
    protected Client $client;
    protected string $baseUrl;
    protected $session;

    public function __construct()
    {
        $this->session = session();

        $envBaseUrl = getenv('API_BASE_URL');

        $this->baseUrl = $envBaseUrl
            ? rtrim($envBaseUrl, '/')
            : 'http://127.0.0.1:8000/api';

        $this->client = new Client([
            'base_uri' => $this->baseUrl . '/',
            'timeout' => 30,
            'http_errors' => false,
        ]);
    }

    protected function headers(): array
    {
        $headers = [
            'Accept' => 'application/json',
        ];

        $token = $this->session->get('token');

        if ($token) {
            $headers['Authorization'] = 'Bearer ' . $token;
        }

        return $headers;
    }

    protected function handleResponse($response)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();

        $contentType = $response->getHeaderLine('Content-Type');

        if (str_contains($contentType, 'application/pdf') ||
            str_contains($contentType, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') ||
            str_contains($contentType, 'application/octet-stream')) {
            return [
                'success' => true,
                'status' => $status,
                'raw' => $body,
                'content_type' => $contentType,
            ];
        }

        $json = json_decode($body, true);

        if ($status === 401) {
            $this->session->destroy();
            return [
                'success' => false,
                'message' => 'Sesi login habis, silakan login ulang.',
                'redirect' => '/login',
            ];
        }

        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'success' => false,
                'status' => $status,
                'message' => 'Response API tidak valid.',
                'raw' => $body,
            ];
        }

        return $json;
    }

    public function get(string $endpoint, array $query = []): array
    {
        try {
            $response = $this->client->get(ltrim($endpoint, '/'), [
                'headers' => $this->headers(),
                'query' => $query,
            ]);

            return $this->handleResponse($response);
        } catch (RequestException $e) {
            return $this->error($e);
        }
    }

    public function post(string $endpoint, array $data = []): array
    {
        try {
            $response = $this->client->post(ltrim($endpoint, '/'), [
                'headers' => $this->headers(),
                'json' => $data,
            ]);

            return $this->handleResponse($response);
        } catch (RequestException $e) {
            return $this->error($e);
        }
    }

    public function put(string $endpoint, array $data = []): array
    {
        try {
            $response = $this->client->put(ltrim($endpoint, '/'), [
                'headers' => $this->headers(),
                'json' => $data,
            ]);

            return $this->handleResponse($response);
        } catch (RequestException $e) {
            return $this->error($e);
        }
    }

    public function delete(string $endpoint): array
    {
        try {
            $response = $this->client->delete(ltrim($endpoint, '/'), [
                'headers' => $this->headers(),
            ]);

            return $this->handleResponse($response);
        } catch (RequestException $e) {
            return $this->error($e);
        }
    }

    public function upload(string $endpoint, array $fields = [], array $files = []): array
    {
        try {
            $multipart = [];

            foreach ($fields as $key => $value) {
                $multipart[] = [
                    'name' => $key,
                    'contents' => $value,
                ];
            }

            foreach ($files as $key => $file) {
                if ($file && $file->isValid()) {
                    $multipart[] = [
                        'name' => $key,
                        'contents' => fopen($file->getTempName(), 'r'),
                        'filename' => $file->getName(),
                    ];
                }
            }

            $response = $this->client->post(ltrim($endpoint, '/'), [
                'headers' => $this->headers(),
                'multipart' => $multipart,
            ]);

            return $this->handleResponse($response);
        } catch (RequestException $e) {
            return $this->error($e);
        }
    }

    public function download(string $endpoint, array $query = []): array
    {
        try {
            $response = $this->client->get(ltrim($endpoint, '/'), [
                'headers' => $this->headers(),
                'query' => $query,
            ]);

            return $this->handleResponse($response);
        } catch (RequestException $e) {
            return $this->error($e);
        }
    }

    protected function error(RequestException $e): array
    {
        return [
            'success' => false,
            'message' => $e->getMessage(),
        ];
    }
}

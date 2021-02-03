<?php

namespace Validationapp\Sdk;

use GuzzleHttp\Client as HttpClient;

class Client
{
    /**
     * @var string
     */
    protected static string $base_uri = 'https://api.validation.app';

    /**
     * @var HttpClient
     */
    protected HttpClient $client;

    /**
     * Validationapp constructor.
     *
     * @param $client_id
     * @param $client_secret
     * @param $api_version
     * @param $redirect_uri
     * @param mixed $token
     */
    public function __construct($token)
    {
        $this->client = new HttpClient([
            'base_uri' => self::$base_uri,
            'headers' => [
                'Authorization' => "Bearer {$token}",
            ],
        ]);
    }

    /**
     * @param $path
     * @param array $query
     * @param array $headers
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($path, array $query = [], array $headers = []): array
    {
        return $this->request('get', $path, $query, $headers);
    }

    /**
     * @param $path
     * @param array $params
     * @param array $headers
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post($path, array $params = [], array $headers = []): array
    {
        return $this->request('post', $path, $params, $headers);
    }

    /**
     * @param $method
     * @param $path
     * @param array $data
     * @param array $headers
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($method, $path, array $data = [], array $headers = []): array
    {
        $method = strtoupper($method);

        $key = $method === 'GET' ? 'query' : 'json';

        $request = $this->client->request($method, $path, [
            $key => $data,
            'headers' => $headers,
        ]);

        $response = json_decode($request->getBody());

        return $response;
    }
}

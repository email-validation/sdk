<?php

namespace Validationapp\Sdk;

class Validationapp
{
    /**
     * @var Client
     */
    protected Client $client;

    /**
     * Validationapp constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $email
     * @param null $ip_address
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function validate($email, $ip_address = null): array
    {
        return $this->client->post('validate', [
            'email' => $email,
            'ip_address' => $ip_address,
        ]);
    }

    /**
     * @param array $emails
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function batch(array $emails): array
    {
        return $this->client->post('batch', [
            'emails' => $emails,
        ]);
    }

    /**
     * @param $uuid
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkBatch($uuid): array
    {
        return $this->client->get("batch/{$uuid}");
    }

    /**
     * @param $email
     * @param int $limit
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function suggest($email, $limit = 5): array
    {
        return $this->client->get('suggest', [
            'email' => $email,
            'limit' => $limit,
        ]);
    }
}

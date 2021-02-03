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

    public function validate($email, $ip_address = null): array
    {
        return $this->client->post('validate', [
            'email' => $email,
            'ip_address' => $ip_address,
        ]);
    }

    public function batch(array $emails): array
    {
        return $this->client->post('batch', [
            'emails' => $emails,
        ]);
    }

    public function checkBatch($uuid): array
    {
        return $this->client->get("batch/{$uuid}");
    }

    public function suggest($email, $limit = 5): array
    {
        return $this->client->get('suggest', [
            'email' => $email,
            'limit' => $limit,
        ]);
    }
}

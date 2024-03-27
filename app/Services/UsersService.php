<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class UsersService {
    private Client $client;

    public function __construct() {
        $this->client = new Client([
            'base_uri' => 'https://randomuser.me/api/'
        ]);
    }

    public function getUser()
    {
        try {
            $response = $this->client->get('');

            return json_decode($response->getBody(), JSON_OBJECT_AS_ARRAY);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

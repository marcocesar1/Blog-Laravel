<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ArticlesService {
    private Client $client;

    public function __construct() {
        $this->client = new Client([
            'base_uri' => 'https://newsapi.org/v2/'
        ]);
    }

    public function getArticles($query)
    {
        try {
            $params = [
                'query' => [
                    'q' => $query,
                    'apiKey' => '1983d2603b984805aa1575b46dfb6f17'
                ]
            ];

            $response = $this->client->get('everything', $params);

            return json_decode($response->getBody(), JSON_OBJECT_AS_ARRAY);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

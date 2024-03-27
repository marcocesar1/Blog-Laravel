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
                    'apiKey' => config('services.news_api_key')
                ]
            ];

            $response = $this->client->get('everything', $params);

            return json_decode($response->getBody(), JSON_OBJECT_AS_ARRAY);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

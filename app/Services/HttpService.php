<?php 

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use \App\Constants\Constants;
use \App\Interface\ServiceInterface;

class HttpService implements ServiceInterface {
    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
        $this->client = new Client([
            'base_uri' => null,
            'timeout' => 0,
            'allow_redirects' => false,
        ]);
    }

    public function getService()
    {
        $response =  $this->client->request('GET', $this->url, $this->sendRequestHeader());
        if ($response->getStatusCode() !== 200){
            throw new \Exception($response->getBody());
        }
        return json_decode($response->getBody(), JSON_OBJECT_AS_ARRAY);
    }

    private function sendRequestHeader() {
        return [
            RequestOptions::HEADERS => [
                'Accept' => 'application/json',
                'X-Authorization' => 'Bearer ' . Constants::MOVIE_API_USERNAME . ":" . base64_encode(Constants::MOVIE_API_PASSWORD),
            ]
        ];
    }
}
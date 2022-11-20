<?php 

namespace App\Classes\Items;

use App\Services\HttpService;
use GuzzleHttp\RequestOptions;
use \App\Constants\Constants;

class ClientItems {

    public function __construct() {
        $this->client = new HttpService;
    }

     public function getService()
    {
        $response =  $this->client->getService()->request('GET', Constants::MOVIE_URI, $this->sendRequestHeader());
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
<?php 

namespace App\Classes\Items;

use App\Services\HttpService;
use GuzzleHttp\RequestOptions;
use \App\Constants\Constants;
use http\Env\Response;
use http\Header;

class ClientItems {

    public function __construct(protected HttpService $client) {
        $this->client = $client;
    }

     public function getService() :array|string
    {
        try{
            $response =  $this->client->getService()->request('GET', Constants::MOVIE_URI, $this->sendRequestHeader());
            if ($response->getStatusCode() !== 200){
                throw new \Exception($response->getBody());
            }
            return json_decode($response->getBody(), JSON_OBJECT_AS_ARRAY);
        }catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    private function sendRequestHeader() {
        return [
            RequestOptions::HEADERS => [
                'Accept' => 'application/json',
                'X-Authorization' => 'Bearer ' . Constants::MOVIE_API_USERNAME . ":" . base64_encode(Constants::MOVIE_API_PASSWORD),
            ]
        ]??
        throw new \Exception("Request header crushed!");
    }
}
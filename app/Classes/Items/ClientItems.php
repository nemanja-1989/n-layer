<?php 

namespace App\Classes\Items;

use App\Services\HttpService;
use GuzzleHttp\RequestOptions;
use \App\Constants\Constants;

class ClientItems {

    /**
     * @param HttpService $client
     */
    public function __construct(protected HttpService $client) {
        $this->client = $client;
    }

    /**
     * @return array|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
     public function getService() :array|string
    {
        try{
            $response =  $this->client->getService()->request('GET', Constants::MOVIE_URI, $this->sendRequestHeader());
            if ($response->getStatusCode() !== 200){
                throw new \Exception($response->getBody());
            }
            return \json_decode($response->getBody(), JSON_OBJECT_AS_ARRAY);
        }catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getServiceSingle($id) :array|string
    {
        try{
            $response =  $this->client->getService()->request('GET', Constants::MOVIE_URI . '/' . $id, $this->sendRequestHeader());
            if ($response->getStatusCode() !== 200){
                throw new \Exception($response->getBody());
            }
            return \json_decode($response->getBody(), JSON_OBJECT_AS_ARRAY);
        }catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return \string[][]
     */
    private function sendRequestHeader() :array  {
        return [
            RequestOptions::HEADERS => [
                'Accept' => 'application/json',
                'X-Authorization' => 'Bearer ' . Constants::MOVIE_API_USERNAME . ":" . base64_encode(Constants::MOVIE_API_PASSWORD),
            ]
        ];
    }
}
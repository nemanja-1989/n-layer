<?php 

namespace App\Services;

use GuzzleHttp\Client;

class HttpService {
    private $url;
    private $timeout;
    private $header;

    public function __construct(string $url, int $timeout = 0, array $header = [])
    {
        $this->url = $url;
        $this->timeout = $timeout;
        $this->header = $header;
        $this->client = new Client();
    }

    public function sendRequest()
    {
        return $this->client->request('GET', $this->url, $this->header);
    }
    
}
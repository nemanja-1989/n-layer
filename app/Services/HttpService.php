<?php 

namespace App\Services;

use GuzzleHttp\Client;
use \App\Interface\ServiceInterface;
class HttpService implements ServiceInterface {

    public function getService()
    {
        return new Client(['base_uri' => null, 'timeout' => 0, 'allow_redirects' => false]);
    }
}
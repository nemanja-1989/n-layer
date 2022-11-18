<?php 
require dirname(__DIR__) . '/vendor/autoload.php';
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\RequestOptions;

const DEFAULT_ACCEPT_HEADER = 'application/json';
    const DEFAULT_CACHE_HEADER = 'no-cache';

$client = new GuzzleClient([
    'base_uri' => null,
    'timeout' => 0,
    'allow_redirects' => false,
]); 

$response = $client->request('GET', 'http://filmapi.loopiarnd.com/items',
            [
                RequestOptions::HEADERS => [
                    'Accept' => 'application/json',
                    'X-Authorization' => 'Bearer username' . ":" . base64_encode('password')
                ]
            ]
        );
    
var_dump(json_decode($response->getBody(), JSON_OBJECT_AS_ARRAY));
exit;
?>
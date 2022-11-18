<?php

namespace App\Traits;

class GetHttpService
{
    public static function getData(\App\Services\HttpService $service): array|\stdClass
    {
        $response = $service->sendRequest();
        if ($response->getStatusCode() !== 200)
            throw new \Exception($response->getBody());
        return json_decode($response->getBody());
    }
}
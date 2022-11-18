<?php 

namespace App\Classes;

use App\Services\RedisService;

class ExecuteCronItems {

    public function run(\App\Services\HttpService $service, \App\Traits\GetHttpService $trait)
    {
        $redis = RedisService::getRedis();
        return $trait::getData($service(MOVIE_URI . 'items'));
        return $redis->set('/v1/items', $trait::getData($service(MOVIE_URI . 'items')));
        if($redis->get('/v1/items')) {
                return 11;
        }else {
            return 12;
        }
    }
}
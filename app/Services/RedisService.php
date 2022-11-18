<?php 

namespace App\Services;

class RedisService {
    
    public static function getRedis() {
        return new \Predis\Client();
    }
}
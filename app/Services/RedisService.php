<?php 

namespace App\Services;

use \App\Interface\ServiceInterface;
class RedisService implements ServiceInterface{
    
    public function getService() {
        return new \Predis\Client();
    }
}
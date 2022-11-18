<?php 

namespace App\Classes;

use App\Services\RedisService;

class ExecuteCronItems {

    public $service;

    public function __construct()
    {
        $this->service = new \App\Services\HttpService('http://filmapi.loopiarnd.com/items');
        $this->redis = RedisService::getRedis();
    }

    public function run()
    { 
        $this->redis->set('/v1/items', json_encode($this->service->sendRequest()));
        $this->setItemsItem();
    }

    private function setItemsItem() {
        $items = json_decode($this->redis->get('/v1/items'), TRUE);
        foreach($items as $item) {
            $this->redis->set('/v1/items/' . $item['id'] , json_encode($item));
        }
    }
}
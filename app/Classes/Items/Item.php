<?php 

namespace App\Classes\Items;

use \App\Classes\Items\ClientItems;
use App\Services\RedisService;

class Item {

    protected ClientItems $client;
    protected RedisService $redis;

    public function __construct(ClientItems $client, RedisService $redis) {
        $this->client = $client;
        $this->redis = $redis;
    }

    public function getItems() {
        return json_encode($this->client->getService());
    }

    public function prepareSingleItemsIterate() {
        return json_decode($this->client->getService()->get('/v1/items'), TRUE);
    }

    private function cacheItems() {
        $this->iterateItems(json_decode($this->getItems(), TRUE));
    }

    private function iterateItems($items) {
        foreach($items as $item) {
            $this->redis->getService()->set('/v1/items/' . $item['id'] , json_encode($item));
        }
    }

    public function redis() {
        return $this->cacheItems();
    }
}
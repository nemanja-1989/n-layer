<?php 

namespace App\Classes\Items;

use App\Services\RedisService;
use App\Classes\Items\ItemsGet;

class ItemsCache {

    protected RedisService $redis;
    protected ItemsGet $items;

    public function __construct(RedisService $redis, ItemsGet $items) {
        $this->redis = $redis;
        $this->items = $items;
    }

    private function cacheItems() {
        $this->iterateItems(json_decode($this->items->getItems(), TRUE));
        $this->redis->getService()->set('/v1/items', $this->items->getItems());
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
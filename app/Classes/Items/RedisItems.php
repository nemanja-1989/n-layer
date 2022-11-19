<?php 

namespace App\Classes\Items;

use App\Services\RedisService;
use \App\Classes\Items\Item;
class RedisItems  {

    public function __construct() {
        $this->item = new Item();
        $this->redis = new RedisService;
    }

    private function cacheItems() {
        $items = json_decode($this->item->getItems(), TRUE);
        $this->iterateItems($items);
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
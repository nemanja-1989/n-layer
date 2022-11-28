<?php 

namespace App\Classes\Items;

require dirname(__DIR__) . '/../Interface/RedisDependency.php';

use App\Interface\RedisDependency;
use App\Services\RedisService;

class ItemsCache implements RedisDependency {

    public function __construct(protected RedisService $redisService, protected ItemsGet $items) {
        $this->redisService = $redisService;
        $this->items = $items;
    }

    public function redisDependencyClassesMethodsForCaching() :string|null {
        return $this->redis();
    }

    private function cacheItems() {
        try{
            $this->iterateItems(json_decode($this->items->getItems(), TRUE));
            $this->redisService->getService()->set('/v1/items', $this->items->getItems());
        }catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    private function iterateItems($items) {
        foreach($items as $item) {
            $this->redisService->getService()->set('/v1/items/' . $item['id'] , json_encode($item));
        }
    }

    private function redis() :string|null {
        return $this->cacheItems();
    }
}
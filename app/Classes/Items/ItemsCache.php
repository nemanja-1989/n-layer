<?php 

namespace App\Classes\Items;

require dirname(__DIR__) . '/../Interface/RedisDependency.php';

use App\Constants\Items\ItemsConstants;
use App\Interface\RedisDependency;
use App\Services\RedisService;

class ItemsCache implements RedisDependency {

    /**
     * @param RedisService $redisService
     * @param ItemsGet $items
     */
    public function __construct
    (
        protected RedisService $redisService,
        protected ItemsGet $items
    )
    {
        $this->redisService = $redisService;
        $this->items = $items;
    }

    /**
     * @return string|null
     */
    public function redisDependencyClassesMethodsForCaching() :string|null {
        return $this->redis();
    }

    /**
     * @return string|void
     */
    private function cacheItems() {
        try{
            $this->iterateItems(json_decode($this->items->getItems(), TRUE));
            $this->redisService->getService()->set(ItemsConstants::ITEMS_CACHE, $this->items->getItems());
        }catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $items
     * @return void
     */
    private function iterateItems($items) {
        foreach($items as $item) {
            $this->redisService->getService()->set(ItemsConstants::itemCache($item['id']) , json_encode($item));
        }
    }

    /**
     * @return string|null
     */
    private function redis() :string|null {
        return $this->cacheItems();
    }
}
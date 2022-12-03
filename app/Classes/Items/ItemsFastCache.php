<?php

namespace App\Classes\Items;

require dirname(__DIR__) . '/../Interface/FastCacheDependency.php';

use App\Interface\FastCacheDependency;
use App\Services\FastCacheService;
use App\Constants\Items\ItemsConstants;

class ItemsFastCache implements FastCacheDependency {

    /**
     * @param FastCacheService $fastCacheService
     * @param ItemsGet $items
     */
    public function __construct
    (
        protected FastCacheService $fastCacheService,
        protected ItemsGet $items
    )
    {
        $this->fastCacheService = $fastCacheService;
        $this->items = $items;
    }

    /**
     * @return string|null
     */
    public function fastCacheDependencyClassesMethodsForCaching() :string|null {
        return $this->fastCache();
    }

    /**
     * @return string|void
     */
    private function fastCacheItems() {
        try{
            $this->iterateItems(json_decode($this->items->getItems(), TRUE));
            $this->fastCacheService->getService()->set(ItemsConstants::ITEMS_CACHE, $this->items->getItems());
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
            $this->fastCacheService->getService()->set(ItemsConstants::itemCache($item['id']) , json_encode($item));
        }
    }

    /**
     * @return string|null
     */
    private function fastCache() :string|null {
        return $this->fastCacheItems();
    }
}
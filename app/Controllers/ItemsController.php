<?php

namespace App\Controllers;

use App\Classes\Items\ItemsGet;
use App\Constants\Items\ItemsConstants;
use App\Services\FastCacheService;
use App\Services\RedisService;

class ItemsController {

    /**
     * @param RedisService $redisService
     * @param FastCacheService $fastCacheService
     * @param ItemsGet $itemsGet
     */
    public function __construct
    (
        protected RedisService $redisService,
        protected FastCacheService $fastCacheService,
        protected ItemsGet $itemsGet
    )
    {
        $this->redisService = $redisService;
        $this->fastCacheService = $fastCacheService;
        $this->itemsGet = $itemsGet;
    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Phpfastcache\Exceptions\PhpfastcacheSimpleCacheException
     */
    public function getItems() :array {
        if($this->redisService->getService()->get(ItemsConstants::ITEMS_CACHE) !== null) {
            $items = $this->redisService->getService()->get(ItemsConstants::ITEMS_CACHE);
        }
        else if($this->fastCacheService->getService()->get(ItemsConstants::ITEMS_CACHE) !== null) {
            $items = $this->fastCacheService->getService()->get(ItemsConstants::ITEMS_CACHE);
        }
        else {
            $items = $this->itemsGet->getItems();
        }
        return \json_decode($items, TRUE);
    }

    /**
     * @param $id
     * @return array
     * @throws \Phpfastcache\Exceptions\PhpfastcacheSimpleCacheException
     */
    public function getSingleItem($id) :array {
        $item = null;
        if($this->redisService->getService()->get(ItemsConstants::itemCache($id)) !== null) {
            $item = $this->redisService->getService()->get(ItemsConstants::itemCache($id));
        }
        else if($this->fastCacheService->getService()->get(ItemsConstants::itemCache($id)) !== null) {
            $item = $this->fastCacheService->getService()->get(ItemsConstants::itemCache($id));
        }
        else {
            $item = $this->itemsGet->getSingleItems($id);
        }
        return \json_decode($item, TRUE);
    }
}
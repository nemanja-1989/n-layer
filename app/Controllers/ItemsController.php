<?php

namespace App\Controllers;

use App\Classes\Items\ItemsGet;
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
        $items = null;
        if($this->redisService->getService()->get('/v1/items') !== null) {
            $items = $this->redisService->getService()->get('/v1/items');
        }
        else if($this->fastCacheService->getService()->get('movies') !== null) {
            $items = $this->fastCacheService->getService()->get('movies');
        }
        else {
            $items = $this->itemsGet->getItems();
        }
        return \json_decode($items, TRUE);
    }

    public function getSingleItem($id) :array {
        $item = null;
        if($this->redisService->getService()->get('/v1/items/' . $id) !== null) {
            $item = $this->redisService->getService()->get('/v1/items/' . $id);
        }
        else if($this->fastCacheService->getService()->get('movies' . $id) !== null) {
            $item = $this->fastCacheService->getService()->get('movies' . $id);
        }
        else {
            $item = $this->itemsGet->getSingleItems($id);
        }
        return \json_decode($item, TRUE);
    }
}
<?php 

namespace App\Console;

use \App\Classes\Items\ItemsCache;
use App\Classes\Items\ItemsFastCache;
use \App\Classes\Items\ItemsGet;
use \App\Classes\Items\ClientItems;
use App\Services\FastCacheService;
use \App\Services\HttpService;
use \App\Services\RedisService;

class ScheduleDependency {

    /**
     * @return array|\Exception
     */
    public function dependencyClassesForScheduleRedis() :array|\Exception {
        return [
            new ItemsCache(new RedisService, new ItemsGet(new ClientItems(new HttpService))),
        ];
    }

    public function dependencyClassesForScheduleFastCache() :array|\Exception {
        return [
            new ItemsFastCache(new FastCacheService, new ItemsGet(new ClientItems(new HttpService))),
        ];
    }
}   
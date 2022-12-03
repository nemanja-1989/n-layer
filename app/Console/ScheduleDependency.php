<?php 

namespace App\Console;

use \App\Classes\Items\ItemsCache;
use App\Classes\Items\ItemsFastCache;
use \App\Classes\Items\ItemsGet;
use \App\Classes\Items\ClientItems;
use App\Containers\AppContainer;
use App\Services\FastCacheService;
use \App\Services\HttpService;
use \App\Services\RedisService;

class ScheduleDependency {

    public function __construct(protected AppContainer $container)
    {
        $this->container = new AppContainer();
    }

    /**
     * @return array|\Exception
     */
    protected function dependencyClassesForScheduleRedis() :array|\Exception {
        return [
            $this->container->get(ItemsCache::class)
        ];
    }

    protected function dependencyClassesForScheduleFastCache() :array|\Exception {
        return [
            $this->container->get(ItemsFastCache::class)
        ];
    }
}   
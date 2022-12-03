<?php 

namespace App\Console;

use App\Constants\Items\ItemsConstants;
use App\Containers\AppContainer;
use App\Interface\FastCacheDependency;
use \App\Interface\RedisDependency;
use App\Services\FastCacheService;
use App\Services\RedisService;

class Schedule extends ScheduleDependency {

    public function __construct()
    {
        parent::__construct(new AppContainer);
    }
    /**
     * @param RedisDependency $redisDependency
     * @return void
     */
    private function runRedis(RedisDependency $redisDependency) :void {
        $redisDependency->redisDependencyClassesMethodsForCaching();
    }

    /**
     * @param FastCacheDependency $fastCacheDependency
     * @return void
     */
    private function runFastCache(FastCacheDependency $fastCacheDependency) :void {
        $fastCacheDependency->fastCacheDependencyClassesMethodsForCaching();
    }

    /**
     * @return void
     */
    private function exeRedis() {
        foreach($this->dependencyClassesForScheduleRedis() as $class) {
            $this->runRedis($class);
        }
    }

    /**
     * @return void
     */
    private function exeFastCache() {
        foreach($this->dependencyClassesForScheduleFastCache() as $class) {
            $this->runFastCache($class);
        }
    }

    private function checkRedisCache() :bool {
        if($this->container->get(RedisService::class)->getService()->get(ItemsConstants::ITEMS_CACHE) === null) {
            return false;
        }
        return true;
    }

    private function checkFastCache() {
        if($this->container->get(FastCacheService::class)->getService()->get(ItemsConstants::ITEMS_CACHE) === null) {
            return false;
        }
        return true;
    }

    /**
     * @return void
     */
    public function exe() {
        $redisCheckCache = $this->checkRedisCache();
        $fastCacheCheckCache = $this->checkFastCache();
        if($redisCheckCache === false || $fastCacheCheckCache === false) {
            $this->exeRedis();
            if($redisCheckCache === false) {
                $this->exeFastCache();
            }
        } 
    }
}   
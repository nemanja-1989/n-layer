<?php 

namespace App\Console;

use App\Interface\FastCacheDependency;
use \App\Interface\RedisDependency;
use App\Services\FastCacheService;
use App\Services\RedisService;

class Schedule extends ScheduleDependency {

    /**
     * @param RedisService $redisService
     * @param FastCacheService $fastCacheService
     */
    public function __construct
    (
        protected RedisService $redisService,
        protected FastCacheService $fastCacheService,
    )
    {
        $this->redisService = $redisService;
        $this->fastCacheService = $fastCacheService;
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
        if($this->redisService->getService()->get('/v1/items') === null) {
            return true;
        }
        return false;
    }

    private function checkFastCache() {
        if($this->fastCacheService->getService()->get('/v1/items') === null) {
            return true;
        }
        return false;
    }

    /**
     * @return void
     */
    public function exe() :void {
        if($this->checkRedisCache() === false || $this->checkFastCache() === false) {
            $this->exeRedis();
            if($this->checkRedisCache() === false) {
                $this->exeFastCache();
            }
        }
    }
}   
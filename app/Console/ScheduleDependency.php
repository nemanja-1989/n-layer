<?php 

namespace App\Console;

use \App\Console\Schedule;
use \App\Classes\Items\ItemsCache;
use \App\Classes\Items\ItemsGet;
use \App\Classes\Items\ClientItems;
use \App\Services\HttpService;
use \App\Services\RedisService;
use \App\Interface\RedisDependency;
/**
 * init services dependencies
 */
$http = new HttpService;
$redis = new RedisService;
/**
 * init classes dependencies
 */
$client = new ClientItems($http);
/**
 * process cache
 */
$items = new ItemsGet($client);
$itemsForCache = new ItemsCache($redis, $items);
$classes = [
    new ItemsCache($redis, $items)
];

class ScheduleDependency {

    public array $scheduleClasses;

    public function __construct() {
        $this->scheduleClasses = [];
        /**
         * services
         */
        $this->httpService = new HttpService;
        $this->redisService = new RedisService;
        /**
         * classes
         */
        // Items
        $this->clientItems = new ClientItems($this->httpService);
        $this->items = new ItemsGet($this->clientItems);
        $this->itemsForCache = new ItemsCache($this->redisService, $this->items);
    }

    public function dependencyClassesForSchedule() {
        return $this->scheduleClasses = [
            $this->itemsForCache
        ] ?? 
        throw new \Exception("Schedule Classes injection Interface broken!");
    }   
}   
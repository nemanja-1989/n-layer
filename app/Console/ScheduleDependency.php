<?php 

namespace App\Console;

use \App\Classes\Items\ItemsCache;
use \App\Classes\Items\ItemsGet;
use \App\Classes\Items\ClientItems;
use \App\Services\HttpService;
use \App\Services\RedisService;

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
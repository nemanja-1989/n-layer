<?php 

namespace App\Console;

use \App\Classes\Items\ItemsCache;
use \App\Classes\Items\ItemsGet;
use \App\Classes\Items\ClientItems;
use \App\Services\HttpService;
use \App\Services\RedisService;

class ScheduleDependency {

    private array $scheduleClasses;

    public function __construct() {
        $this->scheduleClasses = [];
        // Items
        $this->itemsForCache = new ItemsCache(new RedisService, new ItemsGet(new ClientItems(new HttpService)));
    }

    public function dependencyClassesForSchedule() {
        return $this->scheduleClasses = [
            $this->itemsForCache
        ] ?? 
        throw new \Exception("Schedule Classes injection Interface broken!");
    }   
}   
<?php 

namespace App\Console;

use \App\Classes\Items\ItemsCache;
use \App\Classes\Items\ItemsGet;
use \App\Classes\Items\ClientItems;
use \App\Services\HttpService;
use \App\Services\RedisService;

class ScheduleDependency {

    /**
     * @return array|\Exception
     */
    public function dependencyClassesForSchedule() :array|\Exception {
        return [
            new ItemsCache(new RedisService, new ItemsGet(new ClientItems(new HttpService))),
        ];
    }   
}   
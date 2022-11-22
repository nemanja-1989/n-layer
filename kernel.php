<?php 

require './vendor/autoload.php';

use \App\Console\Schedule;
use \App\Classes\Items\ItemsCache;
use App\Classes\Items\ItemsGet;
use \App\Classes\Items\ClientItems;
use App\Services\HttpService;
use \App\Services\RedisService;

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
$exe = new Schedule($itemsForCache);
$exe->run();
?>
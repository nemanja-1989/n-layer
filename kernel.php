<?php 

require './vendor/autoload.php';

use \App\Console\Schedule;
use \App\Classes\Items\Item;
use \App\Classes\Items\ClientItems;
use \App\Services\RedisService;
use \App\Services\HttpService;

//init dependencies
$client = new HttpService;
$client = new ClientItems($client);
$redis = new RedisService;

//cache items
$items = new Item($client, $redis);
$exe = new Schedule($items);
$exe->run();
?>
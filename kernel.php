<?php 

require './vendor/autoload.php';

use App\Services\RedisService;
use App\Classes\ExecuteCronItems;

$cron = new ExecuteCronItems();
$cron->run();
$redis = RedisService::getRedis();
var_dump($redis->get('/v1/items'));

?>
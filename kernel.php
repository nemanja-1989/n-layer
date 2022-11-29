<?php 

require './vendor/autoload.php';

use \App\Console\Schedule;
use App\Services\FastCacheService;
use App\Services\RedisService;

$schedule = new Schedule(new RedisService, new FastCacheService);
$schedule->exe();

<?php 

require './vendor/autoload.php';

use \App\Console\Schedule;
use App\Containers\AppContainer;

$container = new AppContainer();
$schedule = $container->get(Schedule::class);
$schedule->exe();
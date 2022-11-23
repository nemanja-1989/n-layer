<?php 

require './vendor/autoload.php';

use \App\Console\Schedule;

$schedule = new Schedule();
$schedule->exe();
?>
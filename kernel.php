<?php 

require './vendor/autoload.php';

use \App\Console\Schedule;

$exe = new Schedule();
$exe->run();
?>
<?php 

require './vendor/autoload.php';
use App\Classes\ExecuteCronItems;

$cron = new ExecuteCronItems();
$cron->run();
?>
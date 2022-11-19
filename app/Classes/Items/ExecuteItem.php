<?php 

namespace App\Classes\Items;

use \App\Classes\Items\RedisItems;

class ExecuteItem {

    public function __construct() {
        $this->redisItems = new RedisItems();
    }

    public function exe() {
        return $this->redisItems();
    }

    private function redisItems() {
        return $this->redisItems->redis();
    }
    
}  
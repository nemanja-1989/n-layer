<?php 

namespace App\Console;

use \App\Classes\Items\ItemsCache;

class Schedule {

    public function __construct
    (
        protected ItemsCache $items
    )   
    {
        $this->items = $items;
    }
    /**
     * @classes prepare for crontab
     */
    private function schedule() {
        $this->items->redis();
    }

    /**
     * @crontab executable command
     */
    public function run() {
        return $this->schedule() ?? throw new \Exception("Cron crushed!");
    }
    
}   
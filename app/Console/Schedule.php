<?php 

namespace App\Console;

use \App\Classes\Items\Item;

class Schedule {

    protected Item $item;

    public function __construct(Item $item) {
        $this->item = $item;
    }
    /**
     * @classes prepare for crontab
     */
    private function schedule() {
        $this->item->redis();
    }

    /**
     * @crontab executable command
     */
    public function run() {
        return $this->schedule();
    }
    
}   
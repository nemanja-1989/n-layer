<?php 

namespace App\Console;

use \App\Classes\Items\ExecuteItem;

class Schedule {

    public function __construct() {
        $this->item = new ExecuteItem();
    }
    /**
     * @classes prepare for crontab
     */
    private function schedule() {
        $this->item->exe();
    }

    /**
     * @crontab executable command
     */
    public function run() {
        return $this->schedule();
    }
    
}   
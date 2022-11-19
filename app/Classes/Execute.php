<?php 

namespace App\Classes;

use \App\Classes\Items\ExecuteItem;

class Execute {

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
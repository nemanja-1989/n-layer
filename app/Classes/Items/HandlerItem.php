<?php 

namespace App\Classes\Items;

class HandlerItem {

    /**
     * @return void
     */
    public function exeItems()  {
        require_once dirname(__DIR__) . '/../resources/views/items.phtml';
    }

    /**
     * @param $params
     * @return void
     */
    public function exeItem($params) {
        require_once dirname(__DIR__) . '/../resources/views/item.phtml';
    }
}
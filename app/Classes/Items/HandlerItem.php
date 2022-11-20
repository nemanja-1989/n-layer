<?php 

namespace App\Classes\Items;

class HandlerItem {

    public function exeItems() {
        require_once dirname(__DIR__) . '/../resources/views/items.phtml';
    }

    public function exeItem($params) {
        require_once dirname(__DIR__) . '/../resources/views/item.phtml';
    }
}
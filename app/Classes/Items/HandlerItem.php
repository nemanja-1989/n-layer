<?php 

namespace App\Classes\Items;

class HandlerItem {

    public function exeItems()  {
        require_once dirname(__DIR__) . '/../resources/views/items.phtml' ??
        throw new \Exception("Items view does not exists!");
    }

    public function exeItem($params) {
        require_once dirname(__DIR__) . '/../resources/views/item.phtml'??
        throw new \Exception("Item view does not exists!");
    }
}
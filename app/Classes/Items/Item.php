<?php 

namespace App\Classes\Items;

use \App\Classes\Items\ClientItems;
class Item {

    public function __construct() {
        $this->client = new ClientItems;
    }

    public function getItems() {
        return json_encode($this->client->getService());
    }

    public function prepareSingleItemsIterate() {
        return json_decode($this->client->getService()->get('/v1/items'), TRUE);
    }
}
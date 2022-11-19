<?php 

namespace App\Classes\Items;

use \App\Services\HttpService;
use \App\Constants\Constants;
class Item {

    public function __construct() {
        $this->client = new HttpService(Constants::MOVIE_URI);
    }

    public function getItems() {
        return json_encode($this->client->getService());
    }

    public function prepareSingleItemsIterate() {
        return json_decode($this->client->getService()->get('/v1/items'), TRUE);
    }
}
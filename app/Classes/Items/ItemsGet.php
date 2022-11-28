<?php 

namespace App\Classes\Items;

class ItemsGet {

    protected ClientItems $client;

    public function __construct(ClientItems $client) {
        $this->client = $client;
    }

    public function getItems() {
        return json_encode($this->client->getService()) ?? throw new \Exception("Client crushed!");
    } 
}
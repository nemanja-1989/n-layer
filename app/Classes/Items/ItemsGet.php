<?php 

namespace App\Classes\Items;

class ItemsGet {

    /**
     * @param ClientItems $client
     */
    public function __construct
    (
        protected ClientItems $client
    )
    {
        $this->client = $client;
    }

    /**
     * @return string|\Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getItems() : string|\Exception {
        return json_encode($this->client->getService());
    }

    public function getSingleItems($id) : string|\Exception {
        return json_encode($this->client->getServiceSingle($id));
    }
}
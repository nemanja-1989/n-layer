<?php

namespace App\Services;

use \App\Interface\ServiceInterface;
use Phpfastcache\Helper\Psr16Adapter;

class FastCacheService implements ServiceInterface {

    public function getService()
    {
        return new Psr16Adapter('Files');
    }
}
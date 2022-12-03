<?php 

namespace App\Constants\Items;

class ItemsConstants
{
    const ITEMS_CACHE = 'items';
    const ITEMS_URI = 'items';

    public static function itemCache($id) :string {
        return 'items' . $id;
    }

    public static function itemUri($id) :string {
        return 'items' . $id;
    }
}
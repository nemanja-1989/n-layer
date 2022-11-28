<?php
require_once dirname(__DIR__) . '/../n-layer/vendor/autoload.php';

use App\Classes\Items\HandlerItem;
use App\Classes\Movies\Movies;
use \App\Router\Router;
$router = new Router();
/**
 * phpinfo();
 */
$router->get('/php-info', function() {
    require_once dirname(__DIR__) . '/app/resources/phpinfo.php';
});
/**
 * Movies;
 */
$router->get('/', Movies::class . "::movies");
/**
 * Get items
 */
$router->get('/v1/items', HandlerItem::class . "::exeItems");
/**
 * Get item
 */
$router->get('/v1/item', HandlerItem::class . "::exeItem");

//router start
$router->run();
?>
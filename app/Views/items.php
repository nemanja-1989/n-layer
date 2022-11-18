<?php 
use App\Services\RedisService;
?>
<!DOCTYPE html>
<head>
    <title>Movie items</title>
</head>
<body>
    <div>
        <?php 
            $redis = RedisService::getRedis();
            $items = json_decode($redis->get('/v1/items'), TRUE);
            if(count($items) > 0) {
                foreach($items as $item) {
                    echo $item->id;
                }
            }
        ?>
    </div>
</body>
</html>
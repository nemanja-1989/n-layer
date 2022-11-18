<?php 
require './vendor/autoload.php';
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
        ?>
            <?php if (!count($items)): ?>
                <b>No item(s) found!</b>
            <?php else: ?>
                <?php foreach ($items as $item): ?>
                   
                    <div class="item">
                        <dl>
                            <dt>ID: <dd><?php echo $item['id'] ?>
                            <dt>Title: <dd><?php echo $item['title'] ?>
                            <dt>Synopsis: <dd><?php echo $item['synopsis'] ?>
                            <dt><a href="/n-layer/item.php?id=<?php echo $item['id'] ?>">Details: </a>
                    </div>
                <?php endforeach; ?>
            <?php endif ?>
    </div>
</body>
</html>
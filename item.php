<?php 
require './vendor/autoload.php';
use App\Services\RedisService;
use App\Constants\Constants;
?>
<!DOCTYPE html>
<head>
    <title>Movie items</title>
</head>
<body>
        <?php 
            $redis = new RedisService();
            $redis = $redis->getService();
            $item = json_decode($redis->get('/v1/items/' . $_GET['id']), TRUE);
        ?>
        <?php if (!isset($item)): ?>
            <b>No item found!</b>
        <?php else: ?>
            <div class="item">
                <dl>
                    <dt>ID: <dd><?php echo $item['id'] ?>
                    <dt>Title: <dd><?php echo $item['title'] ?>
                    <dt>Synopsis: <dd><?php echo $item['synopsis'] ?>
                </dl>
            </div>
        <?php endif ?>
</body>
</html>
## ENVIRONMENT:
- sudo apt install mysql-server
- sudo apt install apache2
- sudo apt install php8.1

## Commands:

# With cron
- composer install
- sudo apt install redis-server
- crontab -e
- * * * * * php /path-to-your-project/kernel.php >/dev/null 2>&1
- systemctl start redis
- systemctl start cron

# Without cron
- just start /kernel.php to execute cron script object

# Routes
- /
- /v1/items
- /v1/item
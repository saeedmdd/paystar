# Paystar task

## how to run project
```shell
cp .env.example .env
docker-compose build
docker-compose up -d
docker exec -t paystar-php bash -c "composer install"
docker exec -t paystar-php bash -c "php artisan key:generate"
docker exec -t paystar-php bash -c "php artisan migrate --seed"
```

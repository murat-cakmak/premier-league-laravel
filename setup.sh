#!/bin/bash

docker volume create premier-league-mysql-data
docker volume create php-fpm-sync

docker-compose -f docker-compose.yml up -d

cp ./src/.env.example ./src/.env

docker exec -i premier-league_php-fpm composer install
docker exec -i premier-league_php-fpm php artisan key:generate
docker exec -i premier-league_php-fpm php artisan migrate:fresh --seed
docker exec -i premier-league_php-fpm php artisan jwt:secret

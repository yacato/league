#!/bin/bash

docker volume create task-mysql-data
docker volume create php-fpm-sync

docker-compose -f docker-compose.yml up -d

cp ./src/.env.example ./src/.env

docker exec -i task_php-fpm composer install
docker exec -i task_php-fpm php artisan key:generate
docker exec -i task_php-fpm php artisan migrate:fresh --seed
docker exec -i task_php-fpm php artisan jwt:secret

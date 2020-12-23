#!/bin/bash

docker start task_redis
docker start task_mysql
docker start task_php-fpm
docker start task_nginx
docker start task_nodejs

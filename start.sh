#!/bin/bash

echo "Запускаем контейнеры..."
docker compose up -d

echo "Ждем пока все запустится..."
sleep 10

echo "Устанавливаем Composer зависимости..."
docker compose exec -T app composer install --no-interaction --optimize-autoloader

echo "Ждем MySQL..."
until docker compose exec db mysql -u laravel_user -proot -e "SELECT 1" laravel > /dev/null 2>&1; do
  echo "MySQL еще не готов... ждем..."
  sleep 3
done

echo "Выполняем миграции..."
docker compose exec -T app php artisan migrate:fresh --force

echo "Заполняем базу..."
docker compose exec -T app php artisan db:seed --force

echo "CRM: http://localhost:8080"

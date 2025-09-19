# Mini-CRM

Мини-CRM для сбора и обработки заявок с сайта через универсальный виджет.

---

## Описание

Проект представляет собой мини-CRM на Laravel 12 с PHP 8.4.  

Основные возможности:

- Сбор заявок через виджет (`/widget`) с валидацией телефонов (формат E.164).  
- REST API для создания заявок и получения статистики (`/api/tickets`, `/api/tickets/statistics`).  
- Административная панель для менеджеров: просмотр заявок, фильтры, изменение статусов, скачивание файлов.  
- Роли и права через [spatie/laravel-permission](https://spatie.be/docs/laravel-permission/v5/introduction).  
- Файлы заявок через [spatie/laravel-medialibrary](https://spatie.be/docs/laravel-medialibrary/v10/introduction).  
- Тестовые данные через миграции, фабрики и сидеры.

---

## Структура проекта

### Сущности

- **User (менеджер/админ)**: имя, email, пароль  
- **Customer (клиент)**: имя, телефон (E.164), email  
- **Ticket (заявка)**: связь с Customer, тема, текст, статус (новый/в работе/обработан), дата ответа менеджера  
- **File**: файлы заявок через Medialibrary  

### Логика

- Сервисы и репозитории для бизнес-логики  
- Контроллеры только для вызова сервисов  
- Валидация через FormRequest  
- Строго по SOLID, MVC, KISS, DRY, PSR-12  

---

## Развертывание проекта

### Требования

- Docker & Docker Compose  
- PHP 8.4  
- MySQL 8+  

### Быстрый старт через Docker

# Клонируем репозиторий
git clone git@github.com:Dok2314/mini-crm.git
cd mini-crm

# Создаем .env на основе примера
cp .env.example .env

# Запускаем контейнеры (сборка если нужно)
docker-compose up -d --build

# Проверяем, что контейнеры запущены
docker ps

# Устанавливаем зависимости Laravel
docker exec -it crm_php composer install

# Генерируем ключ приложения
docker exec -it crm_php php artisan key:generate

# Применяем миграции и сиды
docker exec -it crm_php php artisan migrate:fresh --seed

# Очистка кэшей (опционально)
docker exec -it crm_php php artisan config:clear
docker exec -it crm_php php artisan cache:clear
docker exec -it crm_php php artisan route:clear
docker exec -it crm_php php artisan view:clear

# Открываем проект в браузере
# http://localhost:8080

# Подключение к MySQL (через Workbench или любой клиент)
# Host: 127.0.0.1
# Port: 3306
# Database: laravel
# Username: laravel_user
# Password: root

# Полезные команды Docker:
# Остановить контейнеры
docker-compose down

# Перезапустить контейнеры
docker-compose restart

# Войти в PHP контейнер
docker exec -it crm_php bash

# Выполнить любую команду Laravel в контейнере
docker exec -it crm_php php artisan <command>

# Смотреть логи контейнеров
docker logs -f crm_nginx
docker logs -f crm_php
docker logs -f crm_db

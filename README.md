# Laravel Test Task

## Требования

- Docker
- Docker Compose
- PHP 8.2 (Laravel 11)

## Установка и запуск

1. Склонируйте репозиторий:
    ```bash
    git clone https://github.com/nurb8k/test_task.git
    cd test_task
   
    ```
2. Создайте .env:
    ```bash
    cp .env.example .env
    ```
3. Установите зависимости:
    ```bash
    composer install
    composer require laravel/sail --dev
    php artisan sail:install
    ```

4. Запустите контейнеры Docker:
    ```bash
    ./vendor/bin/sail up -d
    ```

5. Выполните миграции:
    ```bash
    ./vendor/bin/sail artisan migrate
    ```

# Laravel Test Task

## Требования

- Docker
- Docker Compose

## Установка и запуск

1. Склонируйте репозиторий:
    ```bash
    git clone https://github.com/nurb8k/test_task.git
    cd test_task
    ```

2. Установите зависимости:
    ```bash
    ./vendor/bin/sail composer install
    ```

3. Запустите контейнеры Docker:
    ```bash
    ./vendor/bin/sail up -d
    ```

4. Выполните миграции:
    ```bash
    ./vendor/bin

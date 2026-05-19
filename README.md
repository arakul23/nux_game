# Nux Game

Небольшое Laravel-приложение с регистрацией пользователя, персональной signed-ссылкой и мини-игрой `I'm feeling lucky`.

## Что делает проект

1. Пользователь регистрируется (username + phonenumber).
2. Система создает персональную signed-ссылку с токеном (`link_token`), срок действия - 7 дней.
3. По ссылке доступна игровая страница:
   - запуск игры (генерация числа 1..1000),
   - расчет выигрыша для четных чисел,
   - история последних 3 игр,
   - генерация новой ссылки,
   - отзыв ссылки.
4. Доступ к игровым маршрутам защищен `signed` + middleware `LinkIsValid`.

## Технологии

- PHP 8.3+ (в Docker используется PHP 8.4)
- Laravel 13
- MySQL 8
- Nginx (для Docker-режима)

## Быстрый старт (Docker, рекомендовано)

### Требования

- Docker
- Docker Compose

### Шаги

1. Скопировать env:

```bash
cp .env.example .env
```

2. В `.env` установить:

```dotenv
APP_URL=http://localhost:8083
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=nux_game
DB_USERNAME=root
DB_PASSWORD=root
```

3. Запустить контейнеры:

```bash
docker compose up --build -d
```

4. Сгенерировать ключ приложения (один раз):

```bash
docker compose exec php php artisan key:generate
```

5. Открыть приложение:

`http://localhost:8083`

## Локальный запуск (без Docker)

### Требования

- PHP 8.3+
- Composer
- MySQL 8+
- Node.js 20+ и npm (если нужен Vite dev/build)

### Шаги

1. Установить зависимости:

```bash
composer install
```

2. Подготовить env:

```bash
cp .env.example .env
php artisan key:generate
```

3. Настроить БД в `.env`:

```dotenv
APP_URL=http://127.0.0.1:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nux_game
DB_USERNAME=root
DB_PASSWORD=your_password
```

4. Применить миграции:

```bash
php artisan migrate
```

5. Запустить приложение:

```bash
php artisan serve
```

Открыть: `http://127.0.0.1:8000`

## Полезные команды

```bash
php artisan route:list
php artisan test
```

## Пользовательский сценарий

1. Откройте `/`.
2. Зарегистрируйте пользователя.
3. После редиректа используйте кнопку игры и просмотра истории.
4. Для выдачи новой signed-ссылки используйте `Generate new link`.
5. Для отзыва текущей ссылки используйте `Unsigned link`.

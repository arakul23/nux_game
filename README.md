# Nux Game

A small Laravel application with user registration, a personal signed link, and an `I'm feeling lucky` mini-game.

## Project Overview

1. The user registers (`username` + `phonenumber`).
2. The system generates a personal signed link with a token (`link_token`) valid for 7 days.
3. The link opens the game page with:
   - game start (random number from 1..1000),
   - win calculation for even numbers,
   - history of the last 3 games,
   - new link generation,
   - link revocation.
4. Access to game routes is protected by `signed` + `LinkIsValid` middleware.

## Tech Stack

- PHP 8.3+ (PHP 8.4 is used in Docker)
- Laravel 13
- MySQL 8
- Nginx (for Docker mode)

## Run with Docker

1. Start containers:

```bash
docker compose up --build -d
```

2. Generate the application key (once):

```bash
docker compose exec php php artisan key:generate
```

3. Open the application:

`http://localhost:8083`

Migrations run automatically, and `.env` is created from `.env.example`.

## User Flow

1. Open `/`.
2. Register a user.
3. After redirect, use the game and history buttons.
4. To issue a new signed link, use `Generate new link`.
5. To revoke the current link, use `Unsigned link`.

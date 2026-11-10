# Ecommerce Store

**A Laravel e-commerce foundation with separate customer, seller and administrator authentication.**

[Overview](#overview) · [Local setup](#local-setup) · [Code guide](#code-guide) · [Verification](#verification)

## Overview

A Laravel 12 project exploring multi-guard authentication for an e-commerce application. The codebase includes separate account models and route files alongside catalogue, review and address entities.

## Features

- Separate web, seller and administrator authentication flows.
- Guard-aware login and dashboard routing.
- Custom email verification middleware.
- Product, category, review and address-related data models.

## Technology

| Layer | Stack |
| --- | --- |
| Backend | PHP `^8.2` · Laravel `^12.0` |
| Interface and tooling | Blade · Laravel Breeze · Tailwind CSS · Vite 6 |
| Data | Eloquent ORM · SQLite by default; other configured drivers are available |

Version constraints above come from [composer.json](composer.json) and [package.json](package.json). Use a PHP runtime compatible with `composer.lock`, Composer 2, and a Node.js/npm version compatible with the declared asset tooling. Enable the PHP extensions required by Composer and the selected database driver.

## Local setup

```bash
git clone https://github.com/Moelnabawy8/Ecommerce-Store.git
cd Ecommerce-Store
composer install
cp .env.example .env
php artisan key:generate
npm ci
```

Create the SQLite file if it does not already exist, and point `DB_DATABASE` in your local `.env` to its absolute path:

```bash
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
```

Keep `DB_CONNECTION=sqlite` for this setup. Set `APP_URL=http://127.0.0.1:8000`. For local mail inspection, set `MAIL_MAILER=log` instead of configuring a live mail provider.

```bash
php artisan migrate
php artisan storage:link
npm run build
php artisan serve
```

Open [the local application](http://127.0.0.1:8000). For asset hot reload, run `npm run dev` in a second terminal while the PHP server remains running.

## Project scope

This repository is an e-commerce foundation. The current route and model structure demonstrates account separation and catalogue modelling; it should not be read as a claim that a complete order or payment flow has been implemented.

Start at `/` or `/login`. `/dashboard` selects the dashboard associated with the active guard.

## Code guide

| Path | Responsibility |
| --- | --- |
| [`routes/web.php`](routes/web.php) | Login selection and guard-aware dashboard routing |
| [`routes/users.auth.php`](routes/users.auth.php) | Customer authentication |
| [`routes/sellers.auth.php`](routes/sellers.auth.php) | Seller authentication |
| [`routes/admins.auth.php`](routes/admins.auth.php) | Administrator authentication |
| [`app/Models/`](app/Models/) | Accounts, catalogue, reviews and address entities |

## Verification

The checked-in tests focus on authentication/profile scaffolding. Multi-guard permissions and business flows require dedicated tests.

Use an isolated testing database and review [phpunit.xml](phpunit.xml) before running the suite. Database-resetting tests must point to disposable data.

```bash
php artisan test
```

To check PHP formatting without modifying files:

```bash
./vendor/bin/pint --test
```

Build the front-end assets with `npm run build` after changing JavaScript, CSS or templates. Keep local configuration in `.env` and commit only configuration examples.

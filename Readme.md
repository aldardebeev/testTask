# Блог на PHP + MySQL + Smarty

Тестовое задание: простой блог без фреймворков с категориями и статьями.

## Стек

- PHP 8.1+
- MySQL 8
- Smarty 4
- Docker (nginx + php-fpm + mysql)
- SCSS → CSS

## Быстрый старт (Docker)

```bash
docker compose up -d --build
chmod +x scripts/install.sh
./scripts/install.sh
```
 **http://localhost:8080**

### Ручная установка

```bash
docker compose up -d --build
docker compose exec php composer install
docker compose exec -T mysql mysql -ublog -pblog blog < database/schema.sql
docker compose exec php composer run seed
npm install && npm run build:css   # опционально, если меняли SCSS
```

Скопируйте `.env.example` в `.env` при локальном запуске без Docker (значения по умолчанию уже в `docker-compose.yml`).

## Команды

| Команда | Описание |
|---------|----------|
| `docker compose up -d` | Запуск контейнеров |
| `docker compose exec php composer run seed` | Заполнить БД демо-данными |
| `npm run build:css` | Скомпилировать SCSS |
| `npm run watch:css` | SCSS в watch-режиме |

## Структура проекта

```
public/index.php          # Front controller
config/                   # app.php, database.php
src/
  Controller/             # Home, Category, Article
  Repository/             # SQL-запросы
  Database/Connection.php
  Router.php
templates/                # Smarty-шаблоны
database/
  schema.sql              # Схема БД
  seed.php                # Сидинг
public/assets/
  scss/                   # Исходники стилей
  css/main.css            # Скомпилированный CSS
  uploads/                # Изображения статей
docker/                   # nginx, PHP Dockerfile
```

## Маршруты

| URL | Страница |
|-----|----------|
| `/` | Главная |
| `/category/{slug}` | Категория (сортировка, пагинация) |
| `/article/{slug}` | Статья |

Параметры категории: `?sort=date|views`, `?page=1`.

## Чеклист соответствия ТЗ

| Требование | Статус |
|------------|--------|
| PHP 8.1+, без фреймворков | ✅ |
| Smarty-шаблоны | ✅ |
| MySQL, PDO, prepared statements | ✅ |
| Категория: название, описание | ✅ |
| Статья: изображение, название, описание, текст, категории (M2M), просмотры | ✅ |
| **Главная:** категории только со статьями | ✅ `INNER JOIN` |
| **Главная:** 3 последних поста по `published_at` | ✅ |
| **Главная:** кнопка «Все статьи» | ✅ |
| **Категория:** название, описание, список статей | ✅ |
| **Категория:** сортировка по дате / просмотрам | ✅ `?sort=date\|views` |
| **Категория:** пагинация | ✅ `?page=N` (6 статей на страницу) |
| **Статья:** вся информация | ✅ |
| **Статья:** +1 просмотр при открытии | ✅ |
| **Статья:** 3 похожих (общие категории) | ✅ |
| Сидинг категорий и статей | ✅ `composer run seed` |
| Docker-окружение | ✅ |
| SCSS | ✅ `public/assets/scss/` |

## Проверка вручную

1. Главная — 5 категорий, в каждой до 3 карточек и ссылка «Все статьи».
2. `/category/tech?sort=views` — сортировка по просмотрам; при 8+ статьях — пагинация.
3. `/article/php-81-features` — полный текст, категории, блок «Похожие статьи» (3 шт.).
4. `/category/unknown` — 404.
5. Повторный `composer run seed` — данные пересоздаются.

## База данных

- `categories` — категории
- `articles` — статьи
- `article_categories` — связь many-to-many (статья в нескольких категориях)

Учётные данные (Docker): `blog` / `blog`, БД `blog`, хост `mysql`.

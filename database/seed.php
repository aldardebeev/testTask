<?php

declare(strict_types=1);

use App\Database\Connection;
use App\Env;

require dirname(__DIR__) . '/vendor/autoload.php';

Env::load(dirname(__DIR__) . '/.env');

$config = require dirname(__DIR__) . '/config/database.php';
$pdo = Connection::get($config);

$categories = [
    [
        'name' => 'Технологии',
        'slug' => 'tech',
        'description' => 'Новости IT, гаджеты и разработка программного обеспечения.',
    ],
    [
        'name' => 'Образ жизни',
        'slug' => 'life',
        'description' => 'Привычки, продуктивность и баланс между работой и отдыхом.',
    ],
    [
        'name' => 'Путешествия',
        'slug' => 'travel',
        'description' => 'Маршруты, советы путешественникам и впечатления из поездок.',
    ],
    [
        'name' => 'Кулинария',
        'slug' => 'food',
        'description' => 'Рецепты, обзоры кафе и кухни разных стран.',
    ],
    [
        'name' => 'Наука',
        'slug' => 'science',
        'description' => 'Открытия, исследования и популярное объяснение сложных тем.',
    ],
];

$articles = [
    [
        'slug' => 'php-81-features',
        'title' => 'Что нового в PHP 8.1',
        'description' => 'Краткий обзор enums, readonly-свойств и fibers.',
        'content' => "PHP 8.1 принёс перечисления, readonly-свойства и улучшения производительности.\n\nВ этом материале разбираем, какие возможности стоит применять в новых проектах уже сегодня.",
        'image' => '/assets/uploads/php-81.svg',
        'views_count' => 1240,
        'published_at' => '2026-03-15 10:00:00',
        'categories' => ['tech', 'science'],
    ],
    [
        'slug' => 'docker-for-beginners',
        'title' => 'Docker для начинающих разработчиков',
        'description' => 'Как поднять локальное окружение за 15 минут.',
        'content' => "Docker помогает запускать одинаковое окружение на любой машине.\n\nМы соберём docker-compose с PHP, nginx и MySQL и проверим приложение в браузере.",
        'image' => '/assets/uploads/docker.svg',
        'views_count' => 980,
        'published_at' => '2026-03-12 14:30:00',
        'categories' => ['tech'],
    ],
    [
        'slug' => 'mysql-indexes-guide',
        'title' => 'Индексы в MySQL: практическое руководство',
        'description' => 'Когда индекс ускоряет запрос, а когда мешает.',
        'content' => "Правильные индексы ускоряют выборки, но увеличивают стоимость записи.\n\nРазберём составные индексы на примере блога с категориями и статьями.",
        'image' => '/assets/uploads/mysql.svg',
        'views_count' => 755,
        'published_at' => '2026-03-08 09:15:00',
        'categories' => ['tech', 'science'],
    ],
    [
        'slug' => 'smarty-templates-tips',
        'title' => 'Smarty: советы по шаблонам',
        'description' => 'extends, blocks и безопасный вывод данных.',
        'content' => "Smarty отделяет логику от представления.\n\nИспользуйте {extends}, partials и модификатор escape, чтобы шаблоны оставались читаемыми и безопасными.",
        'image' => '/assets/uploads/smarty.svg',
        'views_count' => 420,
        'published_at' => '2026-03-01 16:45:00',
        'categories' => ['tech'],
    ],
    [
        'slug' => 'morning-routine',
        'title' => 'Утренний распорядок без стресса',
        'description' => 'Пять привычек, которые задают тон дню.',
        'content' => "Стабильный утренний ритуал снижает тревожность и помогает сфокусироваться.\n\nНачните с воды, короткой зарядки и плана на три главные задачи.",
        'image' => '/assets/uploads/morning.svg',
        'views_count' => 610,
        'published_at' => '2026-02-28 07:30:00',
        'categories' => ['life'],
    ],
    [
        'slug' => 'digital-detox-weekend',
        'title' => 'Цифровой детокс на выходных',
        'description' => 'Как отдохнуть от уведомлений и не сорваться в понедельник.',
        'content' => "Полный отказ от гаджетов не всегда реалистичен.\n\nПопробуйте отключить push, оставить только карту и договориться с близкими о способе связи.",
        'image' => '/assets/uploads/detox.svg',
        'views_count' => 890,
        'published_at' => '2026-02-20 11:00:00',
        'categories' => ['life'],
    ],
    [
        'slug' => 'remote-work-ergonomics',
        'title' => 'Эргономика домашнего рабочего места',
        'description' => 'Стул, стол и монитор: на что обратить внимание.',
        'content' => "Неправильная посадка быстро бьёт по спине и зрению.\n\nВысота стола, угол монитора и перерывы каждые 45 минут — базовый минимум.",
        'image' => '/assets/uploads/ergonomics.svg',
        'views_count' => 530,
        'published_at' => '2026-02-14 13:20:00',
        'categories' => ['life', 'tech'],
    ],
    [
        'slug' => 'weekend-in-tbilisi',
        'title' => 'Выходные в Тбилиси',
        'description' => 'Маршрут на два дня: старый город, винные бары, виды.',
        'content' => "Тбилиси удобно исследовать пешком.\n\nВ первый день — старый город и серные бани, во второй — подъём на Нарикала и рынок.",
        'image' => '/assets/uploads/tbilisi.svg',
        'views_count' => 1430,
        'published_at' => '2026-02-10 08:00:00',
        'categories' => ['travel', 'food'],
    ],
    [
        'slug' => 'packing-light-guide',
        'title' => 'Как собрать чемодан в ручную кладь',
        'description' => 'Список вещей для поездки на 5–7 дней.',
        'content' => "Меньше вещей — меньше стресса в аэропорту.\n\nБери универсальную одежду слоями и оставляй 20% места под сувениры.",
        'image' => '/assets/uploads/suitcase.svg',
        'views_count' => 670,
        'published_at' => '2026-02-05 17:10:00',
        'categories' => ['travel'],
    ],
    [
        'slug' => 'train-travel-europe',
        'title' => 'Путешествие по Европе на поездах',
        'description' => 'Interrail, бронирование и экономия времени.',
        'content' => "Поезда часто оказываются быстрее и комфортнее перелётов на коротких дистанциях.\n\nСравните rail pass и разовые билеты под ваш маршрут.",
        'image' => '/assets/uploads/train.svg',
        'views_count' => 1120,
        'published_at' => '2026-01-28 12:00:00',
        'categories' => ['travel', 'life'],
    ],
    [
        'slug' => 'homemade-pasta',
        'title' => 'Домашняя паста с нуля',
        'description' => 'Тесто, соус и ошибки новичков.',
        'content' => "Для базовой пасты нужны мука, яйца и немного терпения.\n\nДайте тесту отдохнуть 30 минут — так проще раскатывать.",
        'image' => '/assets/uploads/pasta.svg',
        'views_count' => 2040,
        'published_at' => '2026-01-22 18:40:00',
        'categories' => ['food'],
    ],
    [
        'slug' => 'filter-coffee-brew',
        'title' => 'Заваривание кофе в воронке',
        'description' => 'Пропорции, помол и температура воды.',
        'content' => "Соотношение 1:16 — хорошая отправная точка.\n\nВода 92–96°C и равномерный пролив дают сладкий чистый вкус.",
        'image' => '/assets/uploads/coffee.svg',
        'views_count' => 1580,
        'published_at' => '2026-01-18 09:50:00',
        'categories' => ['food', 'life'],
    ],
    [
        'slug' => 'street-food-asia',
        'title' => 'Уличная еда в Юго-Восточной Азии',
        'description' => 'Что пробовать и как выбрать безопасную точку.',
        'content' => "Смотрите на очередь местных и свежесть ингредиентов.\n\nНачните с жареного риса и супов — они обычно готовятся на заказ.",
        'image' => '/assets/uploads/street-food.svg',
        'views_count' => 940,
        'published_at' => '2026-01-12 15:25:00',
        'categories' => ['food', 'travel'],
    ],
    [
        'slug' => 'james-webb-discoveries',
        'title' => 'Открытия телескопа James Webb',
        'description' => 'Что инфракрасная астрономия меняет в космологии.',
        'content' => "JWST видит раннюю Вселенную сквозь пылевые облака.\n\nНовые спектры галактик уточняют возраст и состав звёздных систем.",
        'image' => '/assets/uploads/space.svg',
        'views_count' => 2210,
        'published_at' => '2026-01-05 10:30:00',
        'categories' => ['science'],
    ],
    [
        'slug' => 'crispr-explained',
        'title' => 'CRISPR простыми словами',
        'description' => 'Редактирование генов: польза и этические вопросы.',
        'content' => "CRISPR-Cas9 работает как «молекулярные ножницы».\n\nТехнология уже помогает в лечении отдельных генетических заболеваний, но требует строгого контроля.",
        'image' => '/assets/uploads/genetics.svg',
        'views_count' => 1875,
        'published_at' => '2025-12-28 14:00:00',
        'categories' => ['science', 'tech'],
    ],
    [
        'slug' => 'climate-models-101',
        'title' => 'Как строят климатические модели',
        'description' => 'Данные, сценарии и неопределённость прогнозов.',
        'content' => "Модели объединяют атмосферу, океан и ледники.\n\nСценарии SSP помогают оценить последствия разных политик по выбросам.",
        'image' => '/assets/uploads/climate.svg',
        'views_count' => 1320,
        'published_at' => '2025-12-20 11:45:00',
        'categories' => ['science'],
    ],
    [
        'slug' => 'git-workflow-team',
        'title' => 'Git-воркфлоу для небольшой команды',
        'description' => 'feature-ветки, code review и релизы.',
        'content' => "Trunk-based или Git Flow — зависит от частоты деплоя.\n\nГлавное — короткоживущие ветки и понятные сообщения коммитов.",
        'image' => '/assets/uploads/git.svg',
        'views_count' => 640,
        'published_at' => '2025-12-15 16:20:00',
        'categories' => ['tech'],
    ],
    [
        'slug' => 'rest-api-design',
        'title' => 'Проектирование REST API',
        'description' => 'Ресурсы, статусы HTTP и версионирование.',
        'content' => "Именуйте ресурсы во множественном числе и используйте корректные коды ответов.\n\nВерсию API лучше передавать в URL или заголовке Accept.",
        'image' => '/assets/uploads/api.svg',
        'views_count' => 1105,
        'published_at' => '2025-12-10 09:00:00',
        'categories' => ['tech'],
    ],
    [
        'slug' => 'minimalist-home',
        'title' => 'Минимализм в интерьере',
        'description' => 'Как навести порядок и не потерять уют.',
        'content' => "Уберите дублирующие вещи и оставьте то, что используете еженедельно.\n\nНейтральная палитра и хороший свет важнее количества предметов.",
        'image' => '/assets/uploads/home.svg',
        'views_count' => 480,
        'published_at' => '2025-12-05 13:35:00',
        'categories' => ['life'],
    ],
    [
        'slug' => 'winter-balkans-roadtrip',
        'title' => 'Зимний роудтрип по Балканам',
        'description' => 'Дороги, визы и must-see остановки.',
        'content' => "Зимой туристов меньше, но погода капризная.\n\nПроверьте зимнюю резину и запаситесь наличными для мелких парковок.",
        'image' => '/assets/uploads/roadtrip.svg',
        'views_count' => 720,
        'published_at' => '2025-11-30 08:55:00',
        'categories' => ['travel'],
    ],
    [
        'slug' => 'sourdough-starter',
        'title' => 'Закваска для хлеба: с нуля',
        'description' => 'Кормление, активность и первая выпечка.',
        'content' => "Смешивайте цельную и белую муку 1:1 на старте.\n\nРегулярное кормление в тёплом месте даёт пузырьки за 5–7 дней.",
        'image' => '/assets/uploads/bread.svg',
        'views_count' => 1690,
        'published_at' => '2025-11-22 19:10:00',
        'categories' => ['food', 'life'],
    ],
];

echo "Seeding database...\n";

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE article_categories');
$pdo->exec('TRUNCATE TABLE articles');
$pdo->exec('TRUNCATE TABLE categories');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

ensurePlaceholderImages(dirname(__DIR__) . '/public/assets/uploads');

$categoryStmt = $pdo->prepare(
    'INSERT INTO categories (name, slug, description) VALUES (:name, :slug, :description)',
);
$articleStmt = $pdo->prepare(
    'INSERT INTO articles (slug, title, description, content, image, views_count, published_at)
     VALUES (:slug, :title, :description, :content, :image, :views_count, :published_at)',
);
$linkStmt = $pdo->prepare(
    'INSERT INTO article_categories (article_id, category_id) VALUES (:article_id, :category_id)',
);

$pdo->beginTransaction();

try {
    $categoryIds = [];
    foreach ($categories as $category) {
        $categoryStmt->execute($category);
        $categoryIds[$category['slug']] = (int) $pdo->lastInsertId();
    }

    foreach ($articles as $article) {
        $categorySlugs = $article['categories'];
        unset($article['categories']);

        $articleStmt->execute($article);
        $articleId = (int) $pdo->lastInsertId();

        foreach ($categorySlugs as $slug) {
            if (!isset($categoryIds[$slug])) {
                throw new RuntimeException("Unknown category slug: $slug");
            }
            $linkStmt->execute([
                'article_id' => $articleId,
                'category_id' => $categoryIds[$slug],
            ]);
        }
    }

    $pdo->commit();
} catch (Throwable $e) {
    $pdo->rollBack();
    fwrite(STDERR, 'Seed failed: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}

$stats = $pdo->query(
    'SELECT
        (SELECT COUNT(*) FROM categories) AS categories,
        (SELECT COUNT(*) FROM articles) AS articles,
        (SELECT COUNT(*) FROM article_categories) AS links',
)->fetch();

echo sprintf(
    "Done. Categories: %d, articles: %d, links: %d\n",
    $stats['categories'],
    $stats['articles'],
    $stats['links'],
);

function ensurePlaceholderImages(string $directory): void
{
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
    }

    $images = [
        'php-81' => '#2563eb',
        'docker' => '#0ea5e9',
        'mysql' => '#f59e0b',
        'smarty' => '#8b5cf6',
        'morning' => '#f97316',
        'detox' => '#10b981',
        'ergonomics' => '#64748b',
        'tbilisi' => '#ec4899',
        'suitcase' => '#14b8a6',
        'train' => '#6366f1',
        'pasta' => '#ef4444',
        'coffee' => '#78350f',
        'street-food' => '#ca8a04',
        'space' => '#1e3a8a',
        'genetics' => '#7c3aed',
        'climate' => '#059669',
        'git' => '#f97316',
        'api' => '#0284c7',
        'home' => '#a16207',
        'roadtrip' => '#dc2626',
        'bread' => '#d97706',
    ];

    foreach ($images as $name => $color) {
        $path = $directory . '/' . $name . '.svg';
        if (is_file($path)) {
            continue;
        }

        $svg = sprintf(
            '<svg xmlns="http://www.w3.org/2000/svg" width="640" height="360" viewBox="0 0 640 360">
                <rect width="640" height="360" fill="%s"/>
                <text x="50%%" y="50%%" dominant-baseline="middle" text-anchor="middle"
                      font-family="sans-serif" font-size="28" fill="#ffffff">%s</text>
            </svg>',
            htmlspecialchars($color, ENT_QUOTES),
            htmlspecialchars(strtoupper($name), ENT_QUOTES),
        );

        file_put_contents($path, $svg);
    }
}

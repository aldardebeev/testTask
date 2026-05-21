<?php

declare(strict_types=1);

return [
    'debug' => filter_var(getenv('APP_DEBUG') ?: 'true', FILTER_VALIDATE_BOOLEAN),
    'base_url' => getenv('APP_BASE_URL') ?: '',
    'smarty' => [
        'template_dir' => dirname(__DIR__) . '/templates',
        'compile_dir' => dirname(__DIR__) . '/storage/cache/smarty/compile',
        'cache_dir' => dirname(__DIR__) . '/storage/cache/smarty/cache',
    ],
    'pagination' => [
        'per_page' => 6,
    ],
];

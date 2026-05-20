<?php

declare(strict_types=1);

use App\Database\Connection;
use App\Env;
use App\Router;
use App\SmartyFactory;

require dirname(__DIR__) . '/vendor/autoload.php';

Env::load(dirname(__DIR__) . '/.env');

$appConfig = require dirname(__DIR__) . '/config/app.php';
$databaseConfig = require dirname(__DIR__) . '/config/database.php';

if ($appConfig['debug']) {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
}

$smarty = SmartyFactory::create($appConfig['smarty']);
$pdo = Connection::get($databaseConfig);

$router = new Router([
    'config' => $appConfig,
    'smarty' => $smarty,
    'pdo' => $pdo,
]);
$router->dispatch();

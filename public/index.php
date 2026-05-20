<?php

declare(strict_types=1);

use App\Env;
use App\SmartyFactory;

require dirname(__DIR__) . '/vendor/autoload.php';

Env::load(dirname(__DIR__) . '/.env');

$appConfig = require dirname(__DIR__) . '/config/app.php';
require dirname(__DIR__) . '/config/database.php';

$smarty = SmartyFactory::create($appConfig['smarty']);
$smarty->assign('message', 'hello world!');
$smarty->display('hello.tpl');

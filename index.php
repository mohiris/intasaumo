<?php
require_once __DIR__ . "/Core/bootstrap.php";
$routes = require_once "./App/Routes/web.php";

use Core\Application;
use Core\Util\DotEnv;

(new DotEnv(__DIR__ . '/.env'))->load();

$db_config = [
    'db_driver' => getenv('DB_DRIVER'),
    'db_host' => getenv('DB_HOST'),
    'db_name' => getenv('DB_NAME'),
    'db_user' => getenv('DB_USER'),
    'db_password' => getenv('DB_PASSWORD')
];

$email_config = [
    'host' => getenv('HOST'),
    'username' => getenv('USERNAME'),
    'password' => getenv('PASSWORD'),
    'stmp_secure' => getenv('STMP_SECURE'),
    'port' => getenv('PORT')
];

$app = new Application($routes, $db_config);
$app->run();

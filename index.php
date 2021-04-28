<?php
require_once "./Core/bootstrap.php";
$routes = require_once "./App/Routes/web.php";

use Core\Application;
use Core\Util\DotEnv;

(new DotEnv(__DIR__ . '/.env'))->load();

$email_config = [
    'host' => getenv('HOST'),
    'username' => getenv('USERNAME'),
    'password' => getenv('PASSWORD'),
    'stmp_secure' => getenv('STMP_SECURE'),
    'port' => getenv('PORT')
];


$app = new Application($routes);
$app->run();

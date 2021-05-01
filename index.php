<?php
require_once "./Core/bootstrap.php";
require_once "./Core/Vendor/PHPMailer-master/src/PHPMailer.php";
require_once "./Core/Vendor/PHPMailer-master/src/Exception.php";
require_once "./Core/Vendor/PHPMailer-master/src/SMTP.php";
$routes = require_once "./App/Routes/web.php";

use Core\Application;
use Core\Database\DB;
use Core\Util\DotEnv;
use Core\Util\Email;


(new DotEnv(__DIR__ . '/.env'))->load();

$app = new Application($routes);
$app->run();

$email = new Email();
$email->send('contact.goschool@gmail.com', 'antoine.saunier.pro@gmail.com', 'TEST', '<h1>Hello</h1>');

$person = ['firstname' => 'christian', 'lastname' => 'mohindo', 'age' => 25];


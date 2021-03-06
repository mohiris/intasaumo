<?php

$route = new Core\Routing\Route();

/**
 * ===== Site Routes ====
 */

$route->get('/', ['controller' => 'HomeController', 'method' => 'index']);

$route->get('/users/register', ['controller' => 'UserController', 'method' => 'register']);

/**
 * ===== Admin Routes ====
 */
$route->get('/admin', ['controller' => 'DashBoardController', 'method' => 'index']);

$route->get('/admin/login', ['controller' => 'AdminAuthController', 'method' => 'indexLogin']);

$route->get('/admin/register', ['controller' => 'AdminAuthController', 'method' => 'indexRegister']);

$route->post('/admin/register', ['controller' => 'AdminAuthController', 'method' => 'register']);

$route->post('/admin/login', ['controller' => 'AdminAuthController', 'method' => 'login']);

$route->get('/admin/resetpassword', ['controller' => 'AdminAuthController', 'method' => 'indexReset']);

$route->get('/admin/lostpassword', ['controller' => 'AdminLostPassword', 'method' => 'indexLostPassword']);

$route->post('/admin/lostpassword', ['controller' => 'AdminLostPassword', 'method' => 'lostPassword']);


$route->get('/admin/article/add', ['controller' => 'AdminArticleController', 'method' => 'create']);

$route->get('/admin/article', ['controller' => 'AdminArticleController', 'method' => 'index']);

return $route->getRoutes();
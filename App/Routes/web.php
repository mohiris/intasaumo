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

$route->get('/admin/login', ['controller' => 'AdminAuthController', 'method' => 'index']);

$route->get('/admin/article/add', ['controller' => 'AdminArticleController', 'method' => 'create']);

$route->get('/admin/article', ['controller' => 'AdminArticleController', 'method' => 'index']);

return $route->getRoutes();
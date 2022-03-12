<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->post('/login', 'AuthController@loginAction');
$router->get('/pedidos', 'PedidosController@index');
$router->post('/register', 'AuthController@registerAction');
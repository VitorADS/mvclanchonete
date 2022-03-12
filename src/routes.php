<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->post('/login', 'AuthController@loginAction');
$router->get('/pedidos', 'PedidosController@pedidos');
$router->post('/register', 'AuthController@registerAction');
$router->get('/logout', 'AuthController@logout');
<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

$router->post('/login', 'AuthController@loginAction');
$router->get('/logout', 'AuthController@logout');
$router->post('/register', 'AuthController@registerAction');

$router->get('/pedidos', 'PedidosController@pedidos');
$router->get('/verPedido/{np}', 'PedidosController@verPedido');
$router->get('/excluirPedido/{np}', 'PedidosController@excluirPedido');


<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

$router->post('/login', 'AuthController@loginAction');
$router->get('/logout', 'AuthController@logout');
$router->post('/register', 'AuthController@registerAction');

$router->get('/pedidos', 'PedidoController@pedidos');
$router->get('/verPedido/{np}', 'PedidoController@verPedido');
$router->get('/excluirPedido/{np}', 'PedidoController@excluirPedido');

$router->get('/painelAdm', 'AdminController@painelAdm');
$router->get('/painelAdm/users', 'AdminController@getUsers');
$router->get('/painelAdm/editarUser/{id}', 'AdminController@editarUser');
$router->get('/painelAdm/excluirUser/{id}', 'AdminController@excluirUser');
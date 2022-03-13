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

$router->get('/painelAdm', 'AdminController@painelAdm');
$router->get('/painelAdm/users', 'AdminController@getUsers');
$router->get('/painelAdm/editarUser/{id}', 'AdminController@editarUser');
$router->get('/painelAdm/excluirUser/{id}', 'AdminController@excluirUser');

$router->get('/painelAdm/comidas', 'ComidasController@getComidas');
$router->get('/painelAdm/editarComida/{id}', 'ComidasController@editarComidas');
$router->get('/painelAdm/comida/{id}', 'ComidasController@excluirComidas');
$router->get('/painelAdm/adicionarComida', 'ComidasController@adicionarComida');
$router->post('/painelAdm/comidaAction', 'ComidasController@adicionarComidaAction');
$router->get('/painelAdm/excluirComida/{id}', 'ComidasController@excluirComida');
<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

$router->post('/login', 'AuthController@loginAction');
$router->get('/logout', 'AuthController@logout');
$router->post('/register', 'AuthController@registerAction');

$router->get('/pedidos', 'PedidosController@pedidos');
$router->get('/adicionarPedido', 'PedidosController@adicionarPedido');
$router->post('/adicionarItem', 'PedidosController@adicionarItem');
$router->get('/finalizarPedido', 'PedidosController@finalizarPedido');
$router->post('/adicionarPedidoAction', 'PedidosController@adicionarPedidoAction');
$router->get('/verPedido/{np}', 'PedidosController@verPedido');
$router->get('/excluirPedido/{np}', 'PedidosController@excluirPedido');
$router->get('/excluirItem/{id}', 'PedidosController@excluirItem');

$router->get('/painelAdm', 'AdminController@painelAdm');
$router->get('/painelAdm/users', 'AdminController@getUsers');
$router->get('/painelAdm/adicionarUsuario', 'AdminController@adicionarUsuario');
$router->post('/painelAdm/adicionarUsuarioAction', 'AdminController@adicionarUsuarioAction');
$router->get('/painelAdm/editarUser/{id}', 'AdminController@editarUser');
$router->post('/painelAdm/editarUserAction', 'AdminController@editarUserAction');
$router->get('/painelAdm/excluirUser/{id}', 'AdminController@excluirUser');

$router->get('/painelAdm/comidas', 'ComidasController@getComidas');
$router->get('/painelAdm/editarComida/{id}', 'ComidasController@editarComida');
$router->get('/painelAdm/comida/{id}', 'ComidasController@excluirComida');
$router->get('/painelAdm/adicionarComida', 'ComidasController@adicionarComida');
$router->post('/painelAdm/comidaAction', 'ComidasController@adicionarComidaAction');
$router->get('/painelAdm/excluirComida/{id}', 'ComidasController@excluirComida');
$router->post('/painelAdm/editarComidaAction', 'ComidasController@editarComidaAction');
<?php
namespace src\controllers;

use \core\Controller;
use src\models\Pedido;
use src\controllers\AuthController;

class PedidoController extends Controller {
    private $loggedUser;

    public function __construct(){
        $this->loggedUser = AuthController::checkLogin();

        if(!$this->loggedUser){
            $this->redirect('/');
        }
    }

    public function generatePedido($id, $nomeCliente, $numeroPedido, $statusPedido, $data, $total, $user){
        $pedido = new Pedido();
        $pedido->id = $id;
        $pedido->nomeCliente = $nomeCliente;
        $pedido->numeroPedido = $numeroPedido;
        $pedido->statusPedido = $statusPedido;
        $pedido->data = $data;
        $pedido->total = $total;
        $pedido->user = $user;

        return $pedido;
    }

    public function pedidos(){
        $_SESSION['title'] = 'Pedido';
        $pedidos = Pedido::select()->execute();
        if(count($pedidos) > 0){
            $pedidos = $this->generatePedido($pedidos[0]['id'], $pedidos[0]['nomeCliente'], $pedidos[0]['numeroPedido'], 
                                            $pedidos[0]['statusPedido'], $pedidos[0]['data'], $pedidos[0]['total'], $pedidos[0]['user']);

            $this->render('pedidos', [
                'pedidos' => $pedidos
            ]);
        }else{
            $this->render('pedidos');
        }
    }

    public function verPedido($np){
        $pedido = Pedido::select()
                    ->where('numeroPedido', $np)
                    ->execute();

        if(count($pedido) <= 0){
            $this->redirect('/pedidos');
            exit;
        }else{
            $pedido = $this->generatePedido($pedido[0]['id'], $pedido[0]['nomeCliente'], $pedido[0]['numeroPedido'], 
                                            $pedido[0]['statusPedido'], $pedido[0]['data'], $pedido[0]['total'], $pedido[0]['user']);
            
            $_SESSION['title'] = 'Pedido de '.$pedido->name;
            $this->render('pedido', [
                'pedido' => $pedido
            ]);                              
        }
    }

    public function excluirPedido($np){
        $pedido = Pedido::select()
                    ->where('numeroPedido', $np)
                    ->execute();

        if(count($pedido) <= 0){
            $this->redirect('/pedidos');
            exit;
        }else{
            Pedido::delete()->where('numeroPedido', $np)->execute();
            $this->redirect('/pedidos');
        }
    }
}
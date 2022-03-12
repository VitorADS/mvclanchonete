<?php
namespace src\controllers;

use \core\Controller;
use src\models\Pedidos;
use src\controllers\AuthController;

class PedidosController extends Controller {
    private $loggedUser;

    public function __construct(){
        $this->loggedUser = AuthController::checkLogin();

        if(!$this->loggedUser){
            $this->redirect('/');
        }
    }

    public function generatePedido($id, $nomeCliente, $numeroPedido, $statusPedido, $data, $total, $user){
        $pedido = new Pedidos();
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
        $_SESSION['title'] = 'Pedidos';
        $pedidos = Pedidos::select()->execute();
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

    }

    public function excluirPedido($np){
        
    }
}
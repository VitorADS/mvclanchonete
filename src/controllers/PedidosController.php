<?php
namespace src\controllers;

use \core\Controller;
use DateTime;
use src\models\Pedidos;
use src\controllers\AuthController;

class PedidosController extends Controller {
    private $loggedUser;

    public function __construct(){
        date_default_timezone_set('America/Sao_Paulo');
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
        $_SESSION['title'] = 'Pedido';
        $pedidos = Pedidos::select()->execute();
        if(count($pedidos) > 0){
            $array = [];

            foreach($pedidos as $pedido){
                $pedido = $this->generatePedido($pedido['id'], $pedido['nomeCliente'], $pedido['numeroPedido'], 
                                                $pedido['statusPedido'], $pedido['data'], $pedido['total'], $pedido['user']);
                $array[] = $pedido;
            }                                

            $this->render('pedidos', [
                'pedidos' => $array,
                'user' => $this->loggedUser
            ]);
        }else{
            $this->render('pedidos', [
                'user' => $this->loggedUser
            ]);
        }
    }

    public function adicionarPedido(){
        $_SESSION['title'] = 'adicionar Pedido';
        $this->render('adicionarPedido');
    }

    public function adicionarPedidoAction(){
        $name = filter_input(INPUT_POST, 'name');
        $numeroPedido = rand(0, 9999);
        
        $sql = Pedidos::select()
                        ->where('numeroPedido', $numeroPedido)
                        ->execute();
        
        while(count($sql) > 0){
            $numeroPedido = rand(0, 9999);
            $sql = Pedidos::select()
                            ->where('numeroPedido', $numeroPedido)
                            ->execute();
        }

        $data = new DateTime();
        $data = $data->format("Y-m-d H:i:s");

        Pedidos::insert([
            'nomeCliente' => $name,
            'numeroPedido' => $numeroPedido,
            'statusPedido' => 'novo',
            'data' => $data,
            'user' => $this->loggedUser->id
        ])->execute();
    }

    public function verPedido($np){
        $pedido = Pedidos::select()
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
        $pedido = Pedidos::select()
                    ->where('numeroPedido', $np)
                    ->execute();

        if(count($pedido) <= 0){
            $this->redirect('/pedidos');
            exit;
        }else{
            Pedidos::delete()->where('numeroPedido', $np)->execute();
            $this->redirect('/pedidos');
        }
    }
}
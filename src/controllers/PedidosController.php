<?php
namespace src\controllers;

use \core\Controller;
use DateTime;
use src\models\Pedidos;
use src\models\Pedidos_Comida;
use src\models\Comidas;
use src\controllers\ComidasController as ComidasController;
use src\controllers\UsersController as UsersController;
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

    public function getPedido($np){
        $pedido = Pedidos::select()->where('numeroPedido', $np)->execute();
        $pedido = $this->generatePedido($pedido[0]['id'], $pedido[0]['nomeCliente'], $pedido[0]['numeroPedido'], $pedido[0]['statusPedido'],
                                        $pedido[0]['data'], $pedido[0]['total'], $pedido[0]['user']);

        return $pedido;                                
    }

    public function pedidos(){
        $_SESSION['title'] = 'Pedidos';
        $pedidos = Pedidos::select()->execute();
        if(count($pedidos) > 0){
            $array = [];

            foreach($pedidos as $pedido){
                $user = new UsersController;
                $data = new DateTime($pedido['data']);
                $pedido = $this->generatePedido($pedido['id'], $pedido['nomeCliente'], $pedido['numeroPedido'], 
                                                $pedido['statusPedido'], $pedido['data'] = $data->format("d-m-Y H:i"), $pedido['total'], $pedido['user']);                         
                $user = $user->findById($pedido->user);
                $pedido->user = $user->name;
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
            'statusPedido' => 'Novo',
            'data' => $data,
            'user' => $this->loggedUser->id
        ])->execute();

        $this->redirect('/verPedido/'.$numeroPedido);
    }

    public function verPedido($np){
        $pedido = Pedidos::select()
                    ->where('numeroPedido', $np)
                    ->execute();

        $pedido = $this->generatePedido($pedido[0]['id'], $pedido[0]['nomeCliente'], $pedido[0]['numeroPedido'], 
                                $pedido[0]['statusPedido'], $pedido[0]['data'], $pedido[0]['total'], $pedido[0]['user']);

        $data = Pedidos_Comida::select()
                    ->where('idPedido', $pedido->numeroPedido)
                    ->execute();
                    
        $_SESSION['title'] = 'Pedido de '.$pedido->nomeCliente;

        $comidaC = new ComidasController();
        $comidas = $comidaC->getAll();

        $array = [];

        if(count($data) > 0){
            foreach($data as $comida){
                $item = $comidaC->getComida($comida['idComida']);
                $item->quantidade = $comida['quantidade'];
                $item->price = $item->quantidade * $item->price;
                $item->np = $np['np'];
                $array[] = $item;
            }
        }

        $this->render('pedido', [
            'pedido' => $pedido,
            'comidas' => $array,
            'comidasSelect' => $comidas
        ]);                              
        
    }

    public function adicionarItem(){
        $numeroPedido = filter_input(INPUT_POST, 'numeroPedido');
        $produto = filter_input(INPUT_POST, 'produto');
        $quantidade = filter_input(INPUT_POST, 'quantidade');

        $pedido = $this->getPedido($numeroPedido);
        if($pedido->statusPedido == 'Enviado'){
            $_SESSION['flash'] = 'Nao eh possivel editar este pedido, ja foi enviado para producao';
            $this->redirect('/pedidos');
            exit;
        }

        if($produto && $quantidade > 0){
            $verifica = Pedidos_Comida::select()
                        ->where('idPedido', $numeroPedido)
                        ->where('idComida', $produto)
                        ->execute();
            
            if(count($verifica) > 0){
                Pedidos_Comida::update()
                            ->set('quantidade', $verifica[0]['quantidade'] + $quantidade)
                            ->where('idPedido', $numeroPedido)
                            ->where('idComida', $produto)
                            ->execute();
            }else{
                Pedidos_Comida::insert([
                    'idPedido' => $numeroPedido,
                    'idComida' => $produto,
                    'quantidade' => $quantidade
                ])->execute();
            }

            $produto = Comidas::select()->where('id', $produto)->execute();
            $comida = new ComidasController();
            $produto = $comida->getComida($produto[0]['id']);
            $pedido = Pedidos::select()->where('numeroPedido', $numeroPedido)->execute();
            $pedido = $this->generatePedido($pedido[0]['id'], $pedido[0]['nomeCliente'], $pedido[0]['numeroPedido'], 
                                    $pedido[0]['statusPedido'], $pedido[0]['data'], $pedido[0]['total'], $pedido[0]['user']);
                                    
            $pedido->total += ($produto->price * $quantidade);
            $this->atualizaTotal($pedido);      
        }

        $this->redirect('/verPedido/'.$numeroPedido);
    }

    public function excluirItem($id){
        $item = Pedidos_Comida::select()
                ->where('idComida', $id['id'])
                ->where('idPedido', $id['np'])
                ->execute();

        $pedido = $this->getPedido($id['np']);
        if($pedido->statusPedido == 'Enviado'){
            $_SESSION['flash'] = 'Nao eh possivel editar este pedido, ja foi enviado para producao';
            $this->redirect('/pedidos');
            exit;
        }
        
        $comida = new ComidasController();
        $comida = $comida->getComida($item[0]['idComida']);
        $pedido->total -= ($comida->price * $item[0]['quantidade']);
        $this->atualizaTotal($pedido);

        Pedidos_Comida::delete()->where('idComida', $id['id'])
                                ->where('idPedido', $pedido->numeroPedido)
                                ->execute();

        $this->redirect('/verPedido/'.$pedido->numeroPedido);
    }

    public function finalizarPedido(){
        $id = filter_input(INPUT_GET, 'id');
        Pedidos::update()
                ->set('statusPedido', 'Enviado')
                ->where('numeroPedido', $id)
                ->execute();

        $this->redirect('/pedidos');
    }

    public function atualizaTotal(Pedidos $pedido){
        Pedidos::update()
                ->set('total', $pedido->total)
                ->where('numeroPedido', $pedido->numeroPedido)
                ->execute();
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
            $itens = Pedidos_Comida::select()->where('idPedido', $np)->execute();
            if(count($itens) > 0){
                Pedidos_Comida::delete()->where('idPedido', $np)->execute();
            }
        }
        $this->redirect('/pedidos');
    }
}
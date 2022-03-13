<?php
namespace src\controllers;

use \core\Controller;
use src\models\Comidas;
use src\controllers\AdminController as Admin;

class ComidasController extends Controller{

    public function __construct(){
        if(!Admin::isAdm()){
            $this->redirect('/pedidos');
        }
    }

    public function generateComida($id, $name, $price){
        $comida = new Comidas();
        $comida->id = $id;
        $comida->name = $name;
        $comida->price = $price;

        return $comida;
    }

    public function getComidas(){
        $_SESSION['title'] = 'Painel Administrativo - Comidas';
        $comidas = Comidas::select()->execute();
        $array = [];

        if(count($comidas) > 0){
            foreach($comidas as $comida){
                $dado = $this->generateComida($comida['id'], $comida['name'], $comida['price']);          
                $array[] = $dado;
            }
        }   

        $this->render('comidas', [
            'comidas' => $array
        ]);
    }

    public function adicionarComida(){
        $_SESSION['title'] = 'Painel Administrativo - Adicionar Comidas';
        $this->render('adicionarComida');
    }

    public function adicionarComidaAction(){
        $name = filter_input(INPUT_POST, 'name');
        $price = filter_input(INPUT_POST, 'price');

        if($name && $price){
            Comidas::insert([
                'name' => $name,
                'price' => $price
            ])->execute();
        }
        $this->redirect('/painelAdm/comidas');
    }

    public function editarComida($id){
        $_SESSION['title'] = 'Painel Administrativo - Editar Comida';
        $comida = Comidas::select()->where('id', $id)->execute();

        if(count($comida) > 0){
            $comida = $this->generateComida($comida[0]['id'], $comida[0]['name'], $comida[0]['price']);
        }
        $this->render('editarComida', [
            'comida' => $comida
        ]);
    }

    public function editarComidaAction(){
        $id = filter_input(INPUT_POST, 'id');
        $name = filter_input(INPUT_POST, 'name');
        $price = filter_input(INPUT_POST, 'price');

        if($name && $price){
            Comidas::update()
                    ->set('name', $name)
                    ->set('price', $price)
                    ->where('id', $id)
                    ->execute();
        }
        $this->redirect('/painelAdm/comidas');
    }

    public function excluirComida($id){
        Comidas::delete()->where('id', $id)->execute();
        $this->redirect('/painelAdm/comidas');
    }

}
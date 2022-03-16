<?php
namespace src\controllers;

use \core\Controller;
use src\models\Users;
use src\controllers\UsersController as UsersController;

class AdminController extends Controller{

    public function __construct(){
        if(!$this->isAdm()){
            $this->redirect('/pedidos');
        }
    }

    public function checkUser($id){
        if($id == 1){
            $_SESSION['flash'] = 'Nao eh possivel excluir ou editar este usuario';
            $this->redirect('/painelAdm/users');
        }else{
            return false;
        }
    }

    public function painelAdm(){
        $_SESSION['title'] = 'Painel Administrativo';
        $this->render('painelAdm');
    }

    public static function isAdm(){
        $adm = new UsersController();
        $adm = $adm->findByToken($_SESSION['token']);

        return $adm->admin;
    }

    public function getUsers(){
        $_SESSION['title'] = 'Painel Administrativo - Usuarios';
        $array = [];
        
        $users = Users::select()->execute();

        if(count($users) > 0){
            foreach($users as $user){
                $dado = new UsersController();
                $dado = $dado->generateUser($user['id'], $user['name'], $user['password'], $user['token'], $user['firstLogin'], $user['admin']);
                $array[] = $dado;
            }
        }

        $this->render('users', [
            'users' => $array
        ]);
    }

    public function adicionarUsuario(){
        $_SESSION['title'] = 'Painel Administrativo - Adicionar Usuario';
        $this->render('adicionarUsuario');
    }

    public function adicionarUsuarioAction(){
        $name = filter_input(INPUT_POST, 'name');
        $admin = filter_input(INPUT_POST, 'admin');
        $rand = rand(0, 9999);

        if(!$admin){
            $admin = false;
        }
        
        if($name){
            Users::insert([
                'name' => $name,
                'admin' => $admin,
                'password' => $rand,
                'firstLogin' => true
            ])->execute();
            $_SESSION['flash'] = 'Senha temporaria: '.$rand;
        }

        $this->redirect('/painelAdm/users');
    }

    public function editarUser($id){
        if(!$this->checkUser($id['id'])){
            $user = Users::select()->where('id', $id)->execute();

            if(count($user) <= 0){
                $_SESSION['flash'] = 'usuario inexistente';
                $this->redirect('/painelAdm/users');
            }else{
                $dado = new UsersController();
                $user = $dado->generateUser($user[0]['id'], $user[0]['name'], $user[0]['password'], $user[0]['token'], $user[0]['firstLogin'], $user[0]['admin']);
                $_SESSION['title'] = 'Painel Administrativo - Editar '.$user->name;

                $this->render('user', [
                    'user' => $user
                ]);
            }
        }
    }

    public function editarUserAction(){
        $id = filter_input(INPUT_POST, 'id');
        $name = filter_input(INPUT_POST, 'name');
        $admin = filter_input(INPUT_POST, 'admin');
        
        if(!$admin){
            $admin = false;
        }

        if($name){
            $user = new UsersController();
            $user = $user->findById($id);

            Users::update()
                ->set('name', $name)
                ->set('admin', $admin)
                ->where('id', $id)
                ->execute();
        }

        $this->redirect('/painelAdm/users');
    }

    public function excluirUser($id){
        if(!$this->checkUser($id['id'])){
            $user = Users::select()->where('id', $id)->execute();

            if(count($user) <= 0){
                $_SESSION['flash'] = 'usuario inexistente';
                $this->redirect('/painelAdm/users');
            }else{
                Users::delete()->where('id', $id)->execute();
                $this->redirect('/painelAdm/users');
            }
        }
    }

}
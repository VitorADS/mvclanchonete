<?php
namespace src\controllers;

use \core\Controller;
use src\models\User;
use src\controllers\UserController as UserController;

class AdminController extends Controller{

    public function __construct(){
        if(!$this->isAdm()){
            $this->redirect('/pedidos');
        }
    }

    public function painelAdm(){
        $_SESSION['title'] = 'Painel Administrativo';
        $this->render('painelAdm');
    }

    public function isAdm(){
        $adm = new UserController();
        $adm = $adm->findByToken($_SESSION['token']);

        return $adm->admin;
    }

    public function getUsers(){
        $_SESSION['title'] = 'Painel Administrativo - Usuarios';
        $array = [];
        
        $users = User::select()->execute();

        if(count($users) > 0){
            foreach($users as $user){
                $dado = new UserController();
                $dado = $dado->generateUser($user['id'], $user['name'], $user['password'], $user['token'], $user['firstLogin'], $user['admin']);
                $array[] = $dado;
            }
        }

        $this->render('users', [
            'users' => $array
        ]);
    }

    public function editarUser($id){
        $user = User::select()->where('id', $id)->execute();

        if(count($user) <= 0){
            $_SESSION['flash'] = 'usuario inexistente';
            $this->redirect('/painelAdm/users');
        }else{
            $dado = new UserController();
            $user = $dado->generateUser($user[0]['id'], $user[0]['name'], $user[0]['password'], $user[0]['token'], $user[0]['firstLogin'], $user[0]['admin']);
            $_SESSION['title'] = 'Painel Administrativo - Editar '.$user->name;

            $this->render('user', [
                'user' => $user
            ]);
        }
    }

    public function excluirUser($id){
        $user = User::select()->where('id', $id)->execute();

        if(count($user) <= 0){
            $_SESSION['flash'] = 'usuario inexistente';
            $this->redirect('/painelAdm/users');
        }else{
            User::delete()->where('id', $id)->execute();
            $this->redirect('/painelAdm/users');
        }
    }

}
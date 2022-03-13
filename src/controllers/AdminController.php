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
        $array = [];
        
        $users = User::select()->execute();

        if(count($users) > 0){
            foreach($users as $user){
                $dado = new UserController();
                $dado = $dado->generateUser($user[0]['id'], $user[0]['name'], $user[0]['password'], $user[0]['token'], $user[0]['firstLogin'], $user[0]['admin']);
                $array[] = $dado;
            }
        }

        $this->render('users', [
            'users' => $array
        ]);
    }

}
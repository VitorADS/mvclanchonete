<?php
namespace src\controllers;

use \core\Controller;
use src\handlers\UserHandler;

class AuthController extends Controller {

    public function loginAction(){
        $user = filter_input(INPUT_POST, 'user');
        $password = filter_input(INPUT_POST, 'password');
        
        $auth = new UserHandler();
        if($user = $auth->findByUser($user)){
            if(password_verify($password, $user->password)){
                $user->token = md5(time().rand(0, 9999));
                $auth->update($user);
                $_SESSION['token'] = $user->token;
                $this->redirect('/Pedidos');
            }else{
                $_SESSION['flash'] = 'Senha Incorreta!';
            }
        }
        $this->redirect('/');
    }

    public function register($name, $password){
        
    }
}
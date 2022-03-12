<?php
namespace src\controllers;

use \core\Controller;
use src\models\User;
use src\controllers\UserController as UserController;

class AuthController extends Controller {

    public function loginAction(){
        $user = filter_input(INPUT_POST, 'user');
        $password = filter_input(INPUT_POST, 'password');
        
        $auth = new UserController();
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

    public function register($name, $password, $admin){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $hash = md5(time().rand(0, 9999999));
        $token = md5(rand(0, 999999).time());
        
        User::insert()
            ->set('name', $name)
            ->set('password', $password)
            ->set('hash', $hash)
            ->set('token', $token)
            ->set('first_login', true)
            ->set('admin', $admin)
            ->execute();
    }

    public function logout(){

    }
}
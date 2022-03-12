<?php
namespace src\controllers;

use \core\Controller;
use src\models\User;
use src\controllers\UserController as UserController;

class AuthController extends Controller {

    public static function checkLogin(){
        if($_SESSION['token'] != ''){
            $user = new UserController();
            $user = $user->findByToken($_SESSION['token']);
            if(!$user){
                return false;
            }else{
                return $user;
            }
        }
        $_SESSION['token'] = '';
    }

    public function loginAction(){
        $user = filter_input(INPUT_POST, 'user');
        $password = filter_input(INPUT_POST, 'password');
        
        $auth = new UserController();
        if($user = $auth->findById($user)){
            if(password_verify($password, $user->password)){
                $user->token = md5(time().rand(0, 9999));
                $auth->update($user);
                $_SESSION['token'] = $user->token;
                $this->redirect('/pedidos');
            }
        }
        $_SESSION['flash'] = 'Usuario e/ou senha incorretos!';
        $this->redirect('/');
    }

    public function registerAction($name, $password, $admin){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $token = md5(rand(0, 999999).time());
        
        User::insert([
                'name' => $name,
                'password' => $password,
                'admin' => $admin,
                'token' => $token
            ])->execute();
        
        $_SESSION['token'] = $token;
        $this->redirect('/logado');
    }

    public function logout(){
        $_SESSION['token'] = null;
        session_unset();
        session_destroy();
        $this->redirect('/');
    }
}
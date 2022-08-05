<?php
namespace src\controllers;

use \core\Controller;
use src\models\Users;
use src\controllers\UsersController as UsersController;

class AuthController extends Controller {

    public static function checkLogin(){
        if(!empty($_SESSION['token'])){
            $user = new UsersController();
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
        
        $auth = new UsersController();
        if($user = $auth->findById($user)){
            if($user->firstLogin == true && password_verify($password, $user->password)){
                $_SESSION['id'] = $user->id;
                $this->redirect('/firstLogin');
            }
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

    public function firstLogin(){
        $user = new UsersController();
        if($user = $user->findById($_SESSION['id'])){
            if($user->firstLogin == true){
                $this->render('firstLogin', [
                    'user' => $user
                ]);
            }
        }else{
            $this->redirect('/');
        }
    }

    public function firstLoginAction(){
        $id = filter_input(INPUT_POST, 'id');
        $password = filter_input(INPUT_POST, 'password');
        $password2 = filter_input(INPUT_POST, 'password2');

        if($password && $password2){
            if($password == $password2){
                $password = password_hash($password, PASSWORD_DEFAULT);
                $_SESSION['token'] = md5(time().rand(0, 99999));

                Users::update()
                    ->set('firstLogin', 0)
                    ->set('password', $password)
                    ->set('token', $_SESSION['token'])
                    ->where('id', $id)
                    ->execute();
                
                $this->redirect('/pedidos');
                exit;
            }else{
                $_SESSION['flash'] = 'Senhas nao coincidem';
            }
        }else{
            $_SESSION['flash'] = 'Senha nao preenchida';
        }
        $this->redirect('/');
    }

    public function registerAction($name, $password, $admin){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $token = md5(rand(0, 999999).time());
        
        Users::insert([
                'name' => $name,
                'password' => $password,
                'admin' => $admin,
                'token' => $token
            ])->execute();
        
        $_SESSION['token'] = $token;
        $this->redirect('/pedidos');
    }

    public function logout(){
        $_SESSION['token'] = null;
        session_unset();
        session_destroy();
        $this->redirect('/');
    }
}
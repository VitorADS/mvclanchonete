<?php
namespace src\controllers;

use \core\Controller;
use src\models\User;

class UserController extends Controller{

    private $loggedUser;

    public function __construct(){
        $this->loggedUser = $this->checkLogin();

        if(!$this->loggedUser){
            $this->redirect('/');
        }
    }

    public function checkLogin(){
        if($_SESSION['token'] != ''){
            $user = $this->findByToken($_SESSION['token']);
            if(!$user){
                $_SESSION['token'] = '';
            }else{
                return $user;
            }
        }
    }

    public function generateUser($id, $name, $password, $token, $firstLogin, $admin){
            $user = new User();
            $user->id = $id;
            $user->name = $name;
            $user->password = $password;
            $user->token = $token;
            $user->firstLogin = $firstLogin;
            $user->admin = $admin;

            return $user;
    }

    public function update(User $user){
        User::update()
            ->set('name', $user->name)
            ->set('password', $user->password)
            ->set('token', $user->token)
            ->set('firstLogin', $user->firstLogin)
            ->set('admin', $user->admin)
            ->execute();
    }

    public function findById($user){
        $user = User::select()
            ->where('id', $user)
            ->execute();
            
        if(count($user) > 0){
            $user = $this->generateUser($user[0]['id'], $user[0]['name'], $user[0]['password'], $user[0]['token'], $user[0]['firstLogin'], $user[0]['admin']);
            return $user;
        }else{
            return false;
        }
    }

    public function findByToken($token){
        $user = User::select()
            ->where('token', $token)
            ->execute();

        if(count($user) > 0){
            $user = $this->generateUser($user[0]['id'], $user[0]['name'], $user[0]['password'], $user[0]['token'], $user[0]['firstLogin'], $user[0]['admin']);

            return $user;
        }else{
            return false;
        }
    }
}
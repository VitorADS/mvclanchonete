<?php
namespace src\controllers;

use \core\Controller;
use src\models\User;

class UserController extends Controller{

    public function generateUser($id, $name, $password, $hash, $token, $firstLogin, $admin){
            $user = new User();
            $user->id = $id;
            $user->name = $name;
            $user->password = $password;
            $user->hash = $hash;
            $user->token = $token;
            $user->firstLogin = $firstLogin;
            $user->admin = $admin;

            return $user;
    }

    public function update(User $user){
        User::update()
            ->set('name', $user->name)
            ->set('password', $user->password)
            ->set('hash', $user->hash)
            ->set('token', $user->token)
            ->set('first_login', $user->firstLogin)
            ->set('admin', $user->admin)
            ->execute();
    }

    public function findById($user){
        $user = User::select()
            ->where('id', $user)
            ->execute();

        if(count($user) > 0){
            $user = $this->generateUser($user['id'], $user['name'], $user['password'], $user['hash'], $user['token'], $user['first_login'], $user['admin']);

            return $user;
        }else{
            $_SESSION['flash'] = 'Usuario nao encontrado!';
            return false;
        }
    }

    public function findByToken($token){
        $user = User::select()
            ->where('token', $token)
            ->execute();

        if(count($user) > 0){
            $user = $this->generateUser($user['id'], $user['name'], $user['password'], $user['hash'], $user['token'], $user['first_login'], $user['admin']);

            return $user;
        }else{
            $_SESSION['flash'] = 'Usuario nao encontrado!';
            return false;
        }
    }
}
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
            ->set('nome', $user->name)
            ->set('password', $user->password)
            ->set('hash', $user->hash)
            ->set('token', $user->token)
            ->set('primeiro_login', $user->firstLogin)
            ->set('adm', $user->admin)
            ->execute();
    }

    public function findByUser($user){
        $user = User::select()
            ->where('id', $user)
            ->execute();

        if(count($user) > 0){
            $user = $this->generateUser($user['id'], $user['nome'], $user['senha'], $user['hash'], $user['token'], $user['primeiro_login'], $user['adm']);

            return $user;
        }else{
            $_SESSION['flash'] = 'Usuario nao encontrado!';
            return false;
        }
    }
}
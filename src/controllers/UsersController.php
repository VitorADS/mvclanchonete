<?php
namespace src\controllers;

use \core\Controller;
use src\models\Users;

class UsersController extends Controller{

    public function generateUser($id, $name, $password, $token, $firstLogin, $admin){
            $user = new Users();
            $user->id = $id;
            $user->name = $name;
            $user->password = $password;
            $user->token = $token;
            $user->firstLogin = $firstLogin;
            $user->admin = $admin;

            return $user;
    }

    public function update(Users $user){
        Users::update()
            ->set('name', $user->name)
            ->set('password', $user->password)
            ->set('token', $user->token)
            ->set('firstLogin', $user->firstLogin)
            ->set('admin', $user->admin)
            ->where('id', $user->id)
            ->execute();
    }

    public function findById($user){
        $user = Users::select()
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
        $user = Users::select()
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
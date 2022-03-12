<?php
namespace src\controllers;

use \core\Controller;
use src\controllers\AuthController;

class HomeController extends Controller {
    private $loggedUser;

    public function __construct(){
        $this->loggedUser = AuthController::checkLogin();

        if($this->loggedUser){
            $this->redirect('/logado');
        }
    }

    public function index(){
        $_SESSION['title'] = 'Login';
        $this->render('home');
    }

}
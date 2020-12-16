<?php

namespace GreenHouse\Controllers;

use GreenHouse\Core\Auth;
use GreenHouse\Core\Request;
use GreenHouse\Utils\Dbg;

class LoginController extends FrontController {

    protected $layout = "login";

    public function login() {
        if(Auth::getInstance()->isAuth()){
            $this->redirect(route("houses"));
        }else {
            $this->render("login", ["loginError" => Request::valueRequest("loginError")]);
        }
    }

    public function auth() {
        $email = Request::valuePost("mail");
        $password = Request::valuePost("password");
        if($password == null && $email == null){
            $this->redirect(route("/", ["loginError" => "Erreur, veuillez renseigner les champs"]));
        } elseif ($email == null){
            $this->redirect(route("/", ["loginError" => "Erreur de mail"]));
        } elseif ($password == null){
            $this->redirect(route("/", ["loginError" => "Erreur de mot de passe"]));
        } else {
            Auth::getInstance()->login($email, $password);
            $this->redirect(Request::valueRequest("redirect") ?? route("houses"));
        }
    }

}

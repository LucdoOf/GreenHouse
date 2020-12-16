<?php

namespace GreenHouse\Controllers;

use GreenHouse\Core\Auth;
use GreenHouse\Core\Request;
use GreenHouse\Utils\Dbg;

class LoginController extends FrontController {

    const REQUIRE_AUTH = false;
    protected $layout = "login";

    /**
     * Page de connection
     */
    public function login() {
        if (Auth::getInstance()->isAuth()){
            $this->redirect(route("houses"));
        } else {
            $this->render("login", [
                "loginError" => Request::valueRequest("loginError"),
                "redirect"   => Request::valueRequest("redirect")
            ]);
        }
    }

    /**
     * Formulaire de connection
     */
    public function auth() {
        $email = Request::valuePost("mail");
        $password = Request::valuePost("password");
        $error = "Erreur, veuillez renseigner le champ email et le champ mot de passe";
        if($password != null && $email != null){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if(Auth::getInstance()->login($email, $password)) {
                    $this->redirect(Request::valueRequest("redirect") ?? route("houses"));
                } else $error = "Utilisateur inconnu ou mot de passe invalide";
            } else $error = "Email invalide";
        }
        $redirectArray = ["loginError" => $error];
        if(!is_null(Request::valueRequest("redirect"))) $redirectArray["redirect"] = Request::valueRequest("redirect");
        $this->redirect(route("login", $redirectArray));
    }

    public function logout() {
        Auth::getInstance()->logout();
        $this->redirect(route("login"));
    }

}

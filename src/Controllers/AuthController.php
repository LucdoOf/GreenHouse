<?php

namespace GreenHouse\Controllers;

use GreenHouse\Core\Auth;
use GreenHouse\Core\Request;
use GreenHouse\Models\User;
use GreenHouse\Utils\Dbg;

class AuthController extends FrontController {

    const REQUIRE_AUTH = false;
    protected $layout = "login";

    /**
     * Page de connection
     */
    public function login() {
        if (Auth::getInstance()->isAuth()){
            $this->redirect(route("houses"), ["message" => "Connexion effectuée", "type" => "success"]);
        } else {
            $this->render("auth.login", [
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
                    $this->redirect(Request::valueRequest("redirect") ?? route("houses"), ["message" => "Connexion effectuée", "type" => "success"]);
                } else $error = "Utilisateur inconnu ou mot de passe invalide";
            } else $error = "Email invalide";
        }
        $redirectArray = ["loginError" => $error];
        if(!is_null(Request::valueRequest("redirect"))) $redirectArray["redirect"] = Request::valueRequest("redirect");
        $this->redirect(route("login", $redirectArray), ["message" => "Veuillez remplir tout les champs", "type" => "error"]);
    }

    public function logout() {
        Auth::getInstance()->logout();
        $this->redirect(route("login"), ["message" => "Déconnexion effectuée", "type" => "success"]);
    }

    public function signup(){
        $this->render("auth.signup");
    }

    public function signupPost() {
        if(Request::valueRequest("password") == Request::valueRequest("password2")) {
            $user = new User();
            if(Request::valueRequest("password")) {
                $user->password = Request::valueRequest("password");
                $mails = User::getAll(["email" => Request::valueRequest("email")]);
                if(Request::valueRequest("email") && empty($mails)) {
                    $user->email = Request::valueRequest("email");
                    $user->active = 1;
                    $user->role = "user";
                    $user->firstname = Request::valueRequest("firstname");
                    $user->lastname = Request::valueRequest("lastname");
                    $user->gender = Request::valueRequest("gender");
                    $user->save();
                    $this->redirect(route('login'), ["message" => "Inscription effectuée", "type" => "success"]);
                } else {
                    $this->redirect(route('signup'), ["message" => "Email invalide", "type" => "error"]);
                }
            } else {
                $this->redirect(route('signup'), ["message" => "Mot de passe invalide", "type" => "error"]);
            }
        } else {
            $this->redirect(route('signup'), ["message" => "Les mots de passe ne correspondent pas", "type" => "error"]);
        }
    }

}

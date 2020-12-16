<?php

namespace GreenHouse\Core;

use GreenHouse\Models\User;
use GreenHouse\Utils\Dbg;

class Auth {

    const COOKIE_PASSWORD = 'auth_password';
    const COOKIE_EMAIL = 'auth_email';

    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    static $permissions = [
        self::ROLE_ADMIN,
        self::ROLE_USER,
    ];

    /**
     * @var ?Auth Instance courante de l'objet
     */
    private static $instance;

    /**
     * Utilisateur connecté, ou null si déconnecté
     *
     * @var ?User
     */
    public $user = null;

    public function __construct() {
        $this->loginFromCookie();
    }

    /**
     * Retourne l'instance courante de l'objet
     *
     * @return Auth
     */
    public static function getInstance() {
        if(is_null(static::$instance)) static::$instance = new Auth();
        return static::$instance;
    }

    /**
     * Retourne true si l'utilisateur est connecté, false sinon
     *
     * @return bool
     */
    public function isAuth() {
        return !is_null($this->user);
    }

    /**
     * Déconnecte l'utilisateur et retire les cookies
     */
    public function logout() {
        unset($_COOKIE[self::COOKIE_EMAIL]);
        unset($_COOKIE[self::COOKIE_PASSWORD]);
        setcookie(self::COOKIE_EMAIL, null, -1, '/');
        setcookie(self::COOKIE_PASSWORD, null, -1, '/');
        $this->user = null;
    }

    /**
     * Tente de connecter l'utilisateur
     *
     * @param $mail string Mail de l'utilisateur
     * @param $password string Mot de passe de l'utilisateur
     * @return bool True si la connection a réussie, false sinon
     */
    public function login($mail, $password) {
        $user = User::select(["email" => $mail]);
        if($user && $user->exist() && $user->active == 1) {
            if(User::checkPassword($password, $user->password)) {
                $this->auth($user);
                return true;
            }
        }
        return false;
    }

    /**
     * Connecte l'utilisateur et pose les cookies
     *
     * @param User $user
     */
    private function auth(User $user) {
        setcookie(self::COOKIE_EMAIL, $user->email);
        setcookie(self::COOKIE_PASSWORD, $user->password);

        $this->user = $user;
    }

    /**
     * Tente de connecter l'utilisateur en passant par les cookies
     *
     * @return bool
     */
    public function loginFromCookie() {
        $email = isset($_COOKIE[self::COOKIE_EMAIL]) ? $_COOKIE[self::COOKIE_EMAIL] : null;
        $password = isset($_COOKIE[self::COOKIE_PASSWORD]) ? $_COOKIE[self::COOKIE_PASSWORD] : null;
        if (!is_null($email) && !is_null($password)) {
            Dbg::error($email." ".$password);
            return $this->login($email, $password);
        } else {
            $this->logout();
            return false;
        }
    }

}

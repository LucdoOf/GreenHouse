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
     * Utilisateur connecté, ou null si déconnecté
     *
     * @var ?User
     */
    public $user = null;

    public function __construct() {
        $this->loginFromCookie();
    }

    public function isAuth() {
        return !is_null($this->user);
    }

    public function logout() {
        unset($_COOKIE[self::COOKIE_EMAIL]);
        unset($_COOKIE[self::COOKIE_PASSWORD]);
        setcookie(self::COOKIE_EMAIL, null, -1, '/');
        setcookie(self::COOKIE_PASSWORD, null, -1, '/');
        $this->user = null;
    }

    public function login($mail, $password) {
        $user = User::select(["mail" => $mail]);
        if($user && $user->exist() && $user->active == 1) {
            if(User::checkPassword($password, $user->password)) {
                $this->auth($user);
            }
        }
    }

    private function auth(User $user) {
        setcookie(self::COOKIE_EMAIL, $user->email);
        setcookie(self::COOKIE_PASSWORD, $user->password);

        $this->user = $user;

        Dbg::success('Tentative de connexion : ' . $user->id . '> SUCCESS');
    }

    public function loginFromCookie() {
        $email = isset($_COOKIE[self::COOKIE_EMAIL]) ? $_COOKIE[self::COOKIE_EMAIL] : null;
        $password = isset($_COOKIE[self::COOKIE_PASSWORD]) ? $_COOKIE[self::COOKIE_PASSWORD] : null;
        if (!is_null($email) && !is_null($password)) {
            Dbg::logs("Login from cookie");
            $this->login($email, $password);
        }
        $this->logout();
        return false;
    }

}

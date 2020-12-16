<?php

namespace GreenHouse\Models;

class User extends Model {

    const STORAGE = "user";
    const COLUMNS = [
      "id" => true,
      "name" => true,
      "password" => true,
      "email" => false,
      "active" => true
    ];

    public $name;
    public $password;
    public $email;
    public $active;

    /**
     * Vérifie si le mot de passe est correct.
     *
     * @param string $password1
     * @param string $password2
     * @return bool
     */
    public static function checkPassword($password1, $password2) {
        return password_verify($password1, $password2) || (is_dev() && $password1 == $password2);
    }

}

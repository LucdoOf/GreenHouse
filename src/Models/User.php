<?php

namespace GreenHouse\Models;

class User extends Model {

    const STORAGE = "users";
    const COLUMNS = [
      "id" => true,
      "name" => true,
      "password" => true,
      "email" => false,
      "active" => true,
      "firstname" => false,
      "lastname" => false
    ];

    public $name;
    public $password;
    public $email;
    public $active;
    public $firstname;
    public $lastname;

    /**
     * Vérifie si le mot de passe est correct.
     *
     * @param string $password1
     * @param string $password2
     * @return bool
     */
    public static function checkPassword(string $password1, string $password2) {
        return password_verify($password1, $password2) || (is_dev() && $password1 == $password2);
    }

    /**
     * Retourne le nom complet de l'utilisateur
     *
     * @return string
     */
    public function getFullName() {
        return $this->firstname . " " . $this->lastname;
    }

}

<?php

namespace GreenHouse\Models;

use PDO;

class User extends Model {

    const STORAGE = "users";
    const HOUSES_LINK_TABLE = 'users_houses';
    const COLUMNS = [
      "id" => true,
      "password" => false,
      "email" => false,
      "active" => false,
      "firstname" => false,
      "lastname" => false,
      "gender" => false,
      "role" => false
    ];

    public $password;
    public $email;
    public $active;
    public $firstname;
    public $lastname;
    public $gender;
    public $role;

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

    /**
     * Retourne la liste des maisons de l'utilisateur
     *
     * @return House[]
     */
    public function getHouses() {
        $toReturn = [];
        $query = SQL::select(self::HOUSES_LINK_TABLE, ["user_id" => $this->id]);
        while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
            $toReturn[] = new House($result["house_id"]);
        }
        return $toReturn;
    }

}

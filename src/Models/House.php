<?php

namespace GreenHouse\Models;

use PDO;

class House extends Model {

    const STORAGE = "houses";
    const COLUMNS = [
        "id" => true,
        "zipcode" => false,
        "number" => false,
        "isolation_degree" => false,
        "name" => false,
        "eco_level" => false,
        "street" => false,
        "city_id" => false
    ];

    public $zipcode;
    public $number;
    public $isolation_degree;
    public $name;
    public $eco_level;
    public $street;
    public $city_id;

    /**
     * Détermine si une maison appartient ou non à un utilisateur
     *
     * @param User $user
     * @return bool
     */
    public function belongsTo(User $user) {
        $query = SQL::select(User::HOUSES_LINK_TABLE, ["house_id" => $this->id]);
        if ($query->rowCount() > 0) {
            return $query->fetch(PDO::FETCH_ASSOC)["user_id"] == $user->id;
        }
        return false;
    }

}

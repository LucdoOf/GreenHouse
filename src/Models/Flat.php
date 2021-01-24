<?php

namespace GreenHouse\Models;

use DateTime;
use PDO;

class Flat extends Model {

    const STORAGE = "flats";
    const LODGERS_LINK_TABLE = "flats_lodgers";
    const COLUMNS = [
        "id" => true,
        "name" => false,
        "house_id" => false,
        "flat_type_id" => false,
        "security_level" => false,
    ];

    public $name;
    public $house_id;
    public $flat_type_id;
    public $security_level;

    /**
     * Retourne la liste des habitants de l'appartement
     *
     * @param $at ?DateTime Si précisé, filtre les habitants en fonction de la date d'occupation
     * @return User[]
     */
    public function getLinkedLodgers($at = null) {
        $toReturn = [];
        $query = SQL::select(self::LODGERS_LINK_TABLE, ["flat_id" => $this->id]);
        while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
            $endDate = DateTime::createFromFormat("Y-m-d", $result["end_date"]);
            $startDate = DateTime::createFromFormat("Y-m-d", $result["start_date"]);
            if (is_null($at) || ($endDate->getTimestamp() >= $at->getTimestamp() && $startDate->getTimestamp() <= $at->getTimestamp())) {
                $toReturn[] = new User($result["user_id"]);
            }
        }
        return $toReturn;
    }

}

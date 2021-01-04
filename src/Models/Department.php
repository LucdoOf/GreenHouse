<?php

namespace GreenHouse\Models;

class Department extends Model {

    const STORAGE = "departments";
    const COLUMNS = [
      "id" => true,
      "name" => false,
      "region_id" => false,
    ];

    public $name;
    public $region_id;

    /**
     * Retourne la liste des villes rattachées au département
     *
     * @return City[]
     */
    public function getCities() {
        return City::getAll(["department_id" => $this->id]);
    }

}

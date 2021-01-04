<?php

namespace GreenHouse\Models;

class Region extends Model {

    const STORAGE = "regions";
    const COLUMNS = [
      "id" => true,
      "name" => false,
    ];

    public $name;

    /**
     * Retourne la liste des départements rattachés à la région
     *
     * @return Department[]
     */
    public function getDepartments() {
        return Department::getAll(["region_id" => $this->id]);
    }

}

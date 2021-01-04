<?php

namespace GreenHouse\Models;

class City extends Model {

    const STORAGE = "cities";
    const COLUMNS = [
      "id" => true,
      "name" => false,
      "department_id" => false,
    ];

    public $name;
    public $department_id;

    public function getDepartments() {

    }

}

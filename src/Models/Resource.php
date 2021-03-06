<?php

namespace GreenHouse\Models;

class Resource extends Model {

    const STORAGE = "resources";
    const COLUMNS = [
        "id" => true,
        "name" => false,
        "description" => false,
        "min_value" => false,
        "max_value" => false,
        "critical_value" => false,
        "ideal_value" => false
    ];

    public $name;
    public $description;
    public $min_value;
    public $max_value;
    public $critical_value;
    public $ideal_value;

}

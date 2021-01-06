<?php

namespace GreenHouse\Models;

class House extends Model
{

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
}
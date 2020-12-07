<?php

namespace GreenHouse\Models;

class User extends Model {

    const STORAGE = "user";
    const COLUMNS = [
      "id" => true,
      "name" => true,
      "password" => true
    ];

    public $name;
    public $password;

}

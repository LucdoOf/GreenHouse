<?php

namespace GreenHouse\Controllers;

class HousesController extends FrontController {

    public function listHouses() {
        $this->render("houses/list", ["houses" => [
            [
                "id" => 1,
                "name" => "Maison 1",
                "address" => "64 rue Daniel Mayer",
                "isolation_degree" => 1,
                "eco_level" => 2
            ],
            [
                "id" => 2,
                "name" => "Maison 2",
                "address" => "18 rue du Pas de Notre Dame",
                "isolation_degree" => 0,
                "eco_level" => 0
            ],
            [
                "id" => 3,
                "name" => "Maison 3",
                "address" => "24 avenue Maginot",
                "isolation_degree" => 7,
                "eco_level" => 6
            ],
            [
                "id" => 4,
                "name" => "Maison 4",
                "address" => "68 boulevard Jean Jaures",
                "isolation_degree" => 5,
                "eco_level" => 2
            ]
        ]]);
    }

}

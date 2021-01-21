<?php

use GreenHouse\Models\City;
use GreenHouse\Models\Department;
use GreenHouse\Models\Region;
use GreenHouse\Models\SQL;
use GreenHouse\Utils\Dbg;

require "../src/boot.php";

$departments = [
    "Ainvence"                  =>  "Auvergne-Rhone-Alpes",
    "Aisne"                     =>  "Hauts-de-France",
    "Allier"                    =>  "Auvergne-Rhone-Alpes",
    "Alpes-de-Haute-Provence"   =>  "Provence-Alpes-Côte d'Azur",
    "Hautes-Alpes"              =>  "Provence-Alpes-Côte d'Azur",
    "Alpes-Maritimes"           =>  "Provence-Alpes-Côte d'Azur",
    "Ardèche"                   =>  "Auvergne-Rhône-Alpes",
    "Ardennes"                  =>  "Grand Est",
    "Ariège"                    =>  "Occitanie",
    "Aube"                      =>  "Grand Est",
    "Aude"                      =>  "Occitanie",
    "Aveyron"                   =>  "Occitanie",
    "Bouches-du-Rhône"          =>  "Provence-Alpes-Côte d'Azur",
    "Calvados"                  =>  "Normandie",
    "Cantal"                    =>  "Auvergne-Rhone-Alpes",
    "Charente"                  =>  "Nouvelle-Aquitaine",
    "Charente-Maritime"         =>  "Nouvelle-Aquitaine",
    "Cher"                      =>  "Centre-Val de Loire",
    "Corrèze"                   =>  "Nouvelle-Aquitaine",
    "Côte-d'Or"                 =>  "Bourgogne-Franche-Comté",
    "Côtes-d'Armor"             =>  "Bretagne",
    "Creuse"                    =>  "Nouvelle-Aquitaine",
    "Dordogne"                  =>  "Nouvelle-Aquitaine",
    "Doubs"                     =>  "Bourgogne-Franche-Comté",
    "Drôme"                     =>  "Auvergne-Rhone-Alpes",
    "Eure"                      =>  "Normandie",
    "Eure-et-Loir"              =>  "Centre-Val de Loire",
    "Finistère"                 =>  "Bretagne",
    "Corse-du-Sud"              =>  "Corse",
    "Haute-Corse"               =>  "Corse",
    "Gard"                      =>  "Occitanie",
    "Haute-Garonne"             =>  "Occitanie",
    "Gers"                      =>  "Occitanie",
    "Gironde"                   =>  "Nouvelle-Aquitaine",
    "Hérault"                   =>  "Occitanie",
    "Ille-et-Vilaine"           =>  "Bretagne",
    "Indre"                     =>  "Centre-Val de Loire",
    "Indre-et-Loire"            =>  "Centre-Val de Loire",
    "Isère"                     =>  "Auvergne-Rhone-Alpes",
    "Jura"                      =>  "Bourgogne-Franche-Comté",
    "Landes"                    =>  "Nouvelle-Aquitaine",
    "Loir-et-Cher"              =>  "Centre-Val de Loire",
    "Loire"                     =>  "Auvergne-Rhone-Alpes",
    "Haute-Loire"               =>  "Auvergne-Rhone-Alpes",
    "Loire-Atlantique"          =>  "Pays de la Loire",
    "Loiret"                    =>  "Centre-Val de Loire",
    "Lot"                       =>  "Occitanie",
    "Lot-et-Garonne"            =>  "Nouvelle-Aquitaine",
    "Lozère"                    =>  "Occitanie",
    "Maine-et-Loire"            =>  "Pays de la Loire",
    "Manche"                    =>  "Normandie",
    "Marne"                     =>  "Grand Est",
    "Haute-Marne"               =>  "Grand Est",
    "Mayenne"                   =>  "Pays de la Loire",
    "Meurthe-et-Moselle"        =>  "Grand Est",
    "Meuse"                     =>  "Grand Est",
    "Morbihan"                  =>  "Bretagne",
    "Moselle"                   =>  "Grand Est",
    "Nièvre"                    =>  "Bourgogne-Franche-Comté",
    "Nord"                      =>  "Hauts-de-France",
    "Oise"                      =>  "Hauts-de-France",
    "Orne"                      =>  "Normandie",
    "Pas-de-Calais"             =>  "Hauts-de-France",
    "Puy-de-Dôme"               =>  "Auvergne-Rhone-Alpes",
    "Pyrénées-Atlantiques"      =>  "Nouvelle-Aquitaine",
    "Hautes-Pyrénées"           =>  "Occitanie",
    "Pyrénées-Orientales"       =>  "Occitanie",
    "Bas-Rhin"                  =>  "Grand Est",
    "Haut-Rhin"                 =>  "Grand Est",
    "Rhône"                     =>  "Auvergne-Rhone-Alpes",
    "Haute-Saône"               =>  "Bourgogne-Franche-Comté",
    "Saône-et-Loire"            =>  "Bourgogne-Franche-Comté",
    "Sarthe"                    =>  "Pays de la Loire",
    "Savoie"                    =>  "Auvergne-Rhone-Alpes",
    "Haute-Savoie"              =>  "Auvergne-Rhone-Alpes",
    "Paris"                     =>  "Île-de-France",
    "Seine-Maritime"            =>  "Normandie",
    "Seine-et-Marne"            =>  "Île-de-France",
    "Yvelines"                  =>  "Île-de-France",
    "Deux-Sèvres"               =>  "Nouvelle-Aquitaine",
    "Somme"                     =>  "Hauts-de-France",
    "Tarn"                      =>  "Occitanie",
    "Tarn-et-Garonne"           =>  "Occitanie",
    "Var"                       =>  "Provence-Alpes-Côte d'Azur",
    "Vaucluse"                  =>  "Provence-Alpes-Côte d'Azur",
    "Vendée"                    =>  "Pays de la Loire",
    "Vienne"                    =>  "Nouvelle-Aquitaine",
    "Haute-Vienne"              =>  "Nouvelle-Aquitaine",
    "Vosges"                    =>  "Grand Est",
    "Yonne"                     =>  "Bourgogne-Franche-Comté",
    "Territoire de Belfort"     =>  "Bourgogne-Franche-Comté",
    "Essonne"                   =>  "Ile-de-France",
    "Hauts-de-Seine"            =>  "Ile-de-France",
    "Seine-Saint-Denis"         =>  "Ile-de-France",
    "Val-de-Marne"              =>  "Ile-de-France",
    "Val-d'Oise"                =>  "Ile-de-France",
];

foreach ($departments as $departmentName => $regionName) {
    $region = Region::select(["name" => $regionName]);
    if ($region->exist()) {
        $department = new Department();
        $department->region_id = $region->id;
        $department->name = $departmentName;
        $department->save();
    } else {
        Dbg::warning("Unknown region: " . $regionName);
    }
}

/**$zoneData = json_decode(file_get_contents("zones.json"), true);

foreach ($zoneData as $data) {
    $department = Department::select(["name" => $data["admin_name"]]);
    if ($department->exist()) {
        $city = new City();
        $city->name = $data["city"];
        $city->department_id = $department->id;
        $city->save();
    } else {
        Dbg::warning("Unknown department: " . $data["admin_name"]);
    }
}**/

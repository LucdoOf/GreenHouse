<?php

use GreenHouse\Models\City;
use GreenHouse\Models\Flat;
use GreenHouse\Models\FlatType;
use GreenHouse\Models\House;
use GreenHouse\Models\Room;
use GreenHouse\Models\RoomType;
use GreenHouse\Models\RoomTypeFlatType;
use GreenHouse\Models\SQL;
use GreenHouse\Models\User;

SQL::db()->query("SET FOREIGN_KEY_CHECKS=0;");

SQL::truncate(FlatType::STORAGE);
SQL::truncate(User::HOUSES_LINK_TABLE);
SQL::truncate(House::STORAGE);
SQL::truncate(Flat::STORAGE);
SQL::truncate(Room::STORAGE);
SQL::truncate(RoomType::STORAGE);
SQL::truncate(RoomTypeFlatType::STORAGE);

foreach (["T3", "T2", "T1"] as $type) {
    $flatType = new FlatType();
    $flatType->name = $type;
    $flatType->save();

    foreach (["Cuisine", "Salon", "Toilettes", "Salle de bains", "Chambre"] as $roomTypeName) {
        $roomType = new RoomType();
        $roomType->name = $roomTypeName . " " . $type;
        $roomType->save();

        $roomTypeFlatType = new RoomTypeFlatType();
        $roomTypeFlatType->flat_type_id = $flatType->id;
        $roomTypeFlatType->room_type_id = $roomType->id;
        $roomTypeFlatType->save();
    }
}


$house1 = new House();
$house1->zipcode = "37100";
$house1->number = "64";
$house1->isolation_degree = 5;
$house1->name = "Le Millenium";
$house1->eco_level = 5;
$house1->street = "Rue Daniel Mayer";
$house1->city_id = City::select(["name" => "Tours"])->id;
$house1->save();

SQL::insert(User::HOUSES_LINK_TABLE, [
    "user_id" => User::select(["firstname" => "Lucas"])->id,
    "house_id" => $house1->id,
    "start_date" => (new DateTime())->format("Y-m-d"),
    "end_date" => (new DateTime())->add((new DateInterval("P1Y")))->format("Y-m-d")
]);

foreach (["102b", "305a", "206b"] as $key => $number) {
    $flat = new Flat();
    $flat->name = $number;
    $flat->house_id = $house1->id;
    $flat->flat_type_id = FlatType::getAll()[$key]->id;
    $flat->security_level = 4;
    $flat->save();
}

$house2 = new House();
$house2->zipcode = "37100";
$house2->number = "5 bis";
$house2->isolation_degree = 3;
$house2->name = "Résidence du château";
$house2->eco_level = 1;
$house2->street = "Rue du château";
$house2->city_id = City::select(["name" => "Tours"])->id;
$house2->save();

SQL::insert(User::HOUSES_LINK_TABLE, [
    "user_id" => User::select(["firstname" => "Lucas"])->id,
    "house_id" => $house2->id,
    "start_date" => (new DateTime())->format("Y-m-d"),
    "end_date" => (new DateTime())->add((new DateInterval("P1Y")))->format("Y-m-d")
]);

$flat = new Flat();
$flat->name = "4";
$flat->house_id = $house2->id;
$flat->flat_type_id = FlatType::getAll()[0]->id;
$flat->security_level = 2;
$flat->save();

foreach (Flat::getAll() as $flat) {
    foreach (RoomType::getAll([], null, rand(0, count(RoomType::getAll()))) as $roomType) {
        $room = new Room();
        $room->name = $roomType->name;
        $room->room_type_id = $roomType->id;
        $room->flat_id = $flat->id;
        $room->save();
    }
}

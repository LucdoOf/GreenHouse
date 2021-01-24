<?php

use GreenHouse\Models\Device;
use GreenHouse\Models\DeviceType;
use GreenHouse\Models\HarmfullSubstance;
use GreenHouse\Models\Resource;
use GreenHouse\Models\Room;
use GreenHouse\Models\SQL;

SQL::db()->query("SET FOREIGN_KEY_CHECKS=0;");

SQL::truncate(Device::STORAGE);
SQL::truncate(HarmfullSubstance::STORAGE);
SQL::truncate(Resource::STORAGE);
SQL::truncate(DeviceType::SUBSTANCES_LINK_STORAGE);
SQL::truncate(DeviceType::RESOURCES_LINK_STORAGE);
SQL::truncate(DeviceType::STORAGE);

foreach (["Eau", "Électricité", "Gaz"] as $resourceName) {
    $resource = new Resource();
    $resource->name = $resourceName;
    $resource->description = addslashes("L'" . $resourceName . ", c'est bien");
    $resource->min_value = 0;
    $resource->max_value = 100*24*30;
    $resource->critical_value = 150*24*30;
    $resource->ideal_value = 50*24*30;
}

foreach (["Plutonium", "CO2", "Méthane"] as $substanceName) {
    $substance = new HarmfullSubstance();
    $substance->name = $substanceName;
    $substance->description = "Le" . $substanceName . ", c'est mal";
    $substance->min_value = 0;
    $substance->max_value = 100*24*30;
    $substance->critical_value = 150*24*30;
    $substance->ideal_value = 50*24*30;
}

foreach (["Réfrigérateur", "Micro-ondes", "Appareil à raclette", "Plaques à induction", "Four", "Lave vaisselle"] as $deviceTypeName) {
    $deviceType = new DeviceType();
    $deviceType->name = $deviceTypeName;
    $deviceType->save();

    foreach (Resource::getAll([], null, rand(0, count(Resource::getAll()))) as $resource) {
        SQL::insert(DeviceType::RESOURCES_LINK_STORAGE, [
            "resource_id" => $resource->id,
            "device_type_id" => $deviceType->id,
            "consumption_rate" => rand(0, 175)
        ]);
    }

    foreach (HarmfullSubstance::getAll([], null, rand(0, count(HarmfullSubstance::getAll()))) as $substance) {
        SQL::insert(DeviceType::SUBSTANCES_LINK_STORAGE, [
            "substance_id" => $substance->id,
            "device_type_id" => $deviceType->id,
            "production_rate" => rand(0, 175)
        ]);
    }
}

$possibleLocations = ["Près de la fenêtre", "Sur la table", "Dans l'armoire", "Sur l'étagère", "Sur le plan"];

foreach (Room::getAll() as $room) {
    foreach (DeviceType::getAll([], null, rand(0, count(DeviceType::getAll()))) as $deviceType) {
        $device = new Device();
        $device->name = $deviceType->name;
        $device->demonstration_video = "https://www.youtube.com/watch?v=J13GI4Xik1o&ab_channel=Gojira";
        $device->location = addslashes($possibleLocations[rand(0, count($possibleLocations)-1)]);
        $device->description = addslashes("C'est un bel appareil");
        $device->device_type_id = $deviceType->id;
        $device->flat_id = $room->flat_id;
        $device->save();
    }
}

<?php

namespace GreenHouse\Models;

use PDO;

class DeviceType extends Model {

    const STORAGE = "device_types";
    const SUBSTANCES_LINK_STORAGE = "device_types_harmfull_substances";
    const RESOURCES_LINK_STORAGE = "device_types_resources";
    const COLUMNS = [
        "id" => true,
        "name" => false,
    ];

    public $name;

    /**
     * Retourne la liste des substances liées
     *
     * @return HarmfullSubstance[]
     */
    public function getLinkedSubstances() {
        $toReturn = [];
        foreach (SQL::select(self::SUBSTANCES_LINK_STORAGE, ["device_type_id" => $this->id]) as $row) {
            $toReturn[] = new HarmfullSubstance($row["harmfull_substance_id"]);
        }
        return $toReturn;
    }

    /**
     * Retourne la liste des ressources liées
     *
     * @return Resource[]
     */
    public function getLinkedResources() {
        $toReturn = [];
        foreach (SQL::select(self::RESOURCES_LINK_STORAGE, ["device_type_id" => $this->id]) as $row) {
            $toReturn[] = new Resource($row["resource_id"]);
        }
        return $toReturn;
    }

    /**
     * Retourne le taux de consommation pour une resource donnée
     *
     * @param $resource Resource
     * @return ?float
     */
    public function getConsumptionRateFor($resource) {
        $result = SQL::select(self::RESOURCES_LINK_STORAGE, ["device_type_id" => $this->id, "resource_id" => $resource->id]);
        if (!empty($result)) {
            return floatval($result->fetch(PDO::FETCH_ASSOC)["consumption_rate"]);
        }
        return null;
    }

    /**
     * Retourne le taux de consommation pour une substance donnée
     *
     * @param $substance HarmfullSubstance
     * @return ?float
     */
    public function getProductionRateFor(HarmfullSubstance $substance) {
        $result = SQL::select(self::SUBSTANCES_LINK_STORAGE, ["device_type_id" => $this->id, "harmfull_substance_id" => $substance->id]);
        if (!empty($result)) {
            return floatval($result->fetch(PDO::FETCH_ASSOC)["production_rate"]);
        }
        return null;
    }

}

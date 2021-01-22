<?php

namespace GreenHouse\Models;

use DateTime;
use GreenHouse\Utils\Dbg;

class Device extends Model {

    const STORAGE = "devices";
    const COLUMNS = [
        "id" => true,
        "name" => false,
        "demonstration_video" => false,
        "location" => false,
        "description" => false,
        "device_type_id" => false,
        "flat_id" => false
    ];

    public $name;
    public $demonstration_video;
    public $location;
    public $description;
    public $device_type_id;
    public $flat_id;

    /**
     * Retourne la liste des mesures liées
     *
     * @return Measure[]
     */
    public function getLinkedMeasures() {
        return Measure::getAll(["device_id" => $this->id, "start_date"]);
    }

    /**
     * Retourne le type de l'appareil
     *
     * @return DeviceType
     */
    public function getType() {
        return new DeviceType($this->device_type_id);
    }

    /**
     * Retourne le montant de substance produit à l'instant T
     *
     * @param $substance HarmfullSubstance
     * @param $date DateTime
     * @return float|int
     */
    public function getProductionAt(HarmfullSubstance $substance, DateTime $date) {
        $toReturn = 0;
        foreach ($this->getLinkedMeasures() as $measure) {
            if ($measure->startDate()->getTimestamp() < $date->getTimestamp() && $measure->endDate()->getTimestamp() < $date->getTimestamp()) {
                $toReturn += $this->getType()->getProductionRateFor($substance) * count_days_between($measure->startDate(), $measure->endDate());
            }
        }
        return $toReturn;
    }

    /**
     * Retourne le montant de substance produit à l'instant T
     *
     * @param $resource Resource
     * @param $date DateTime
     * @return float|int
     */
    public function getConsumptionAt($resource, DateTime $date) {
        $toReturn = 0;
        foreach ($this->getLinkedMeasures() as $measure) {
            if ($measure->startDate()->getTimestamp() < $date->getTimestamp() && $measure->endDate()->getTimestamp() <= $date->getTimestamp()) {
                $toReturn += $this->getType()->getConsumptionRateFor($resource) * count_days_between($measure->startDate(), $measure->endDate());
            }
        }
        return $toReturn;
    }

    /**
     * Retourne une array avec en clé le nom des substances / resources et en valeur le montant consommé / produit
     *
     * @return array
     */
    public function getFormatedStatsArray() {
        $data = [];

        foreach ($this->getLinkedMeasures() as $measure) {
            foreach ($this->getType()->getLinkedSubstances() as $substance) {
                $data[$substance->name][] = $this->getProductionAt($substance, $measure->endDate());
            }
            foreach ($this->getType()->getLinkedResources() as $resource) {
                $data[$resource->name][] = $this->getConsumptionAt($resource, $measure->endDate());
            }
        }

        $toReturn = [];
        foreach ($data as $key => $value) {
            $toReturn[] = [
                "label" => $key,
                "data" => $value
            ];
        }

        Dbg::logs("Stats:");
        Dbg::logs($toReturn);

        return $toReturn;
    }

}

<?php

namespace GreenHouse\Models;

use DateTime;
use Exception;
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
            if ($measure->startDate()->getTimestamp() < $date->getTimestamp() && $measure->endDate()->getTimestamp() >= $date->getTimestamp()) {
                $toReturn += ($this->getType()->getProductionRateFor($substance)) *
                    24 * count_days_between($measure->startDate(), $measure->endDate()) *
                    count($this->getFlat()->getLinkedLodgers($date));
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
            if ($measure->startDate()->getTimestamp() < $date->getTimestamp() && $measure->endDate()->getTimestamp() >= $date->getTimestamp()) {
                $toReturn += $this->getType()->getConsumptionRateFor($resource) *
                    24 * count_days_between($measure->startDate(), $measure->endDate()) *
                    count($this->getFlat()->getLinkedLodgers($date));
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
        $labels = [];

        foreach ($this->getLinkedMeasures() as $measure) {
            $labels[] = $measure->startDate()->format("d/m/Y") . ' - ' . $measure->endDate()->format("d/m/Y");

            foreach ($this->getType()->getLinkedSubstances() as $substance) {
                $data[$substance->name][] = $this->getProductionAt($substance, $measure->endDate());
            }
            foreach ($this->getType()->getLinkedResources() as $resource) {
                $data[$resource->name][] = $this->getConsumptionAt($resource, $measure->endDate());
            }
        }

        $toReturn = ["datasets" => [], "labels" => $labels];
        foreach ($data as $key => $value) {
            try {
                $toReturn["datasets"][] = [
                    "label" => $key,
                    "data" => $value,
                    "backgroundColor" => 'rgba(' . random_int(0, 255) . ',' . random_int(0, 255) . ',' . random_int(0, 255) . ', 0.2)'
                ];
            } catch (Exception $e) {
                Dbg::error("An error occurred generating random color: " . $e->getMessage());
            }
        }

        return $toReturn;
    }

    /**
     * Retourne l'appartement associé
     *
     * @return Flat
     */
    public function getFlat() {
        return new Flat($this->flat_id);
    }

}

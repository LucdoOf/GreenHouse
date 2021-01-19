<?php

namespace GreenHouse\Models;

use Cassandra\Date;
use DateTime;

class Measure extends Model {

    const STORAGE = "measures";
    const COLUMNS = [
      "id" => true,
      "start_date" => false,
      "end_date" => false,
      "device_id" => false
    ];

    public $start_date;
    public $end_date;
    public $device_id;

    /**
     * Retourne un objet DateTime représentant la fin de la mesure
     *
     * @return DateTime
     */
    public function endDate() {
        if ($this->end_date instanceof DateTime) {
            return $this->end_date;
        } else {
            return DateTime::createFromFormat("Y-m-d", $this->end_date);
        }
    }

    /**
     * Retourne un objet DateTime représentant le début de la mesure
     *
     * @return DateTime
     */
    public function startDate() {
        if ($this->start_date instanceof DateTime) {
            return $this->start_date;
        } else {
            return DateTime::createFromFormat("Y-m-d", $this->start_date);
        }
    }

}

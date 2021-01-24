<?php
/** @var $regions Region[] */

use GreenHouse\Models\Region;
?>

<div class="row">
    <div class="col-6 wr">
        <div class="row">
            <?php include "zones/list.htm.php"; ?>
        </div>
        <div class="row">
            <?php include "deviceTypes/list.htm.php"; ?>
        </div>
    </div>
    <div class="col-6 wr">
        <div class="row">
            <?php include "resources/list.htm.php"; ?>
        </div>
        <div class="row">
            <?php include "substances/list.htm.php"; ?>
        </div>
        <div class="row">
            <?php include "roomTypes/list.htm.php"; ?>
        </div>
        <div class="row">
            <?php include "flatTypes/list.htm.php"; ?>
        </div>
    </div>
</div>

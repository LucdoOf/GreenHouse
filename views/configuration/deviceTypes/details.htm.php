<?php
/** @var DeviceType $deviceType */

$substances = $deviceType->getLinkedSubstances();
$resources = $deviceType->getLinkedResources();

use GreenHouse\Models\DeviceType;
?>

<div class="row">
    <?php include APPLICATION_PATH . "/views/configuration/substances/list.htm.php"; ?>
    <?php include APPLICATION_PATH . "/views/configuration/resources/list.htm.php"; ?>
</div>

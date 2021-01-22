<?php
/** @var $device Device */

use GreenHouse\Models\Device;
?>

<div class="box col-6">
    <div class="box-header">
        <span class="box-title">Statistiques</span>
    </div>
    <div class="box-content">
        <canvas id="chart" width="400"></canvas>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
<script type="text/javascript">
    window.addEventListener("load", () => {
        new Chart(document.getElementById("chart"), {
            type: 'line',
            data: <?= json_encode($device->getFormatedStatsArray()) ?>
        });
    });
</script>

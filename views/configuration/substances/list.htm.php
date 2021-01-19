<?php
/** @var $substances HarmfullSubstance */

use GreenHouse\Models\HarmfullSubstance;
?>

<div class="box col-6 no-padding">
    <div class="box-header">
        <div class="box-title">Substances</div>
        <div class="box-actions">
            <a class="button" onclick="substancesModal.show()">Ajouter</a>
        </div>
    </div>
    <div class="box-content">
        <div class="table-wrapper">
            <table class="table <?= empty($houses) ? 'empty' : '' ?>">
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Valeurs recommandées (min, ideal, max, critical)</th>
                    <?php if (isset($deviceType)): ?>
                        <th>Taux de production (/h)</th>
                    <?php endif; ?>
                </tr>
                <?php foreach ($substances as $substance): ?>
                    <tr>
                        <td><?= $substance->name; ?></td>
                        <td><?= $substance->description; ?></td>
                        <td><?= $substance->min_value;  ?> < <?= $substance->ideal_value ?> < <?= $substance->max_value; ?> < <?= $substance->critical_value; ?></td>
                        <?php if(isset($deviceType)): ?>
                            <td><?= $deviceType->getProductionRateFor($substance); ?></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    let substancesModal;
    window.addEventListener("load", () => {
        <?php if(!isset($deviceType)): ?>
            substancesModal = new Modal({view_url: '<?= route("configuration.substances.create") ?>', title: 'Ajouter une substance'});
        <?php else: ?>
            substancesModal = new Modal({view_url: '<?= route("configuration.device-types.substances.link", [$deviceType->id]) ?>', title: 'Ajouter une substance'});
        <?php endif; ?>
        substancesModal.build();
    });
</script>

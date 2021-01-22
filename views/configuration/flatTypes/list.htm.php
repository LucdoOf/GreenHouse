<?php
/** @var FlatType[] $flat_types */

use GreenHouse\Models\FlatType;
?>

<div class="box col-6">
    <div class="box-header">
        <div class="box-title">Types D'appartements</div>
        <div class="box-actions">
            <div class="button-input">
                <form method="POST" action="<?= route("configuration.flat-types.create") ?>">
                    <input class="input" name="flat_type_name" type="text" placeholder="T2"/>
                    <input class="button" type="submit" value="+"/>
                </form>
            </div>
        </div>
    </div>
    <div class="box-content">
        <div class="menu-group">
            <?php foreach ($flat_types as $flat_type): ?>
                <?php include "flatTypes.htm.php"; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

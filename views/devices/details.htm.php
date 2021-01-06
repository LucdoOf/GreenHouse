<?php
/** @var Device $device */
?>
<div class="row">
    <div class="box col-6">
        <div class="box-header">
            <span class="box-title"><?= $device->name; ?></span>
        </div>
        <form method="POST" action="<?= route('device.edit', [$device->id]) ?>">
            <div class="box-content">
                <div class="field">
                    <div class="label">Identifiant</div>
                    <div name="id" class="value" ><?= $device->id; ?></div>
                </div>
                <div class="field">
                    <div class="label">Nom</div>
                    <input name="name" class="value" type="text" value="<?= $device->name; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Lien de la vidéo de démonstration</div>
                    <input name="video" class="value" type="text" value="<?= $device->demonstration_video; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Position</div>
                    <input name="location" class="value" type="text" value="<?= $device->location; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Description</div>
                    <input name="description" class="value" type="text" value="<?= $device->description; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Identifiant du type d'appareil</div>
                    <input name="type_id" class="value" type="text" value="<?= $device->device_type_id; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Identifiant de l'appartement</div>
                    <input name="flat_id" class="value" type="text" value="<?= $device->flat_id; ?>"/>
                </div>
            </div>
            <div class="box-footer">
                <div class="button-group">
                    <a href="<?= route('device', [$device->id]) ?>" class="button">Annuler</a>
                    <button type="submit" class="button cta">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>
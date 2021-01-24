<?php
/** @var Device $device
 *  @var Type $types
 *  @var Flat $flats
 */
?>
<div class="row">
    <div class="box col-12 col-md-6">
        <div class="box-header">
            <span class="box-title">Nouvel appareil :</span>
        </div>
        <form method="POST" action="<?= route('device.create') ?>">
            <div class="box-content">
                <div class="field">
                    <div class="label">Nom</div>
                    <input name="name" class="value" type="text" value="Un téléviseur"/>
                </div>
                <div class="field">
                    <div class="label">Lien de la vidéo de démonstration</div>
                    <input name="video" class="value" type="text" value="Youtube.fr/..."/>
                </div>
                <div class="field">
                    <div class="label">Position</div>
                    <input name="location" class="value" type="text" value="Dans la cuisine, chambre..."/>
                </div>
                <div class="field">
                    <div class="label">Description</div>
                    <input name="description" class="value" type="text" value="Mon téléviseur portable..."/>
                </div>
                <div class="field">
                    <div class="label">Type d'appareil</div>
                    <select name="type_id" class="value">
                        <option disabled>Sélectionner un appareil</option>
                        <?php foreach ($types as $type): ?>
                            <option value="<?= $type->id; ?>" <?= $device->device_type_id == $type->id ? "selected" : ""?>><?= $type->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="field">
                    <div class="label">Appartement</div>
                    <select name="flat_id" class="value">
                        <option disabled>Sélectionner un appartement</option>
                        <?php foreach ($flats as $flat): ?>
                            <option value="<?= $flat->id; ?>" <?= $device->flat_id == $flat->id ? "selected" : ""?>><?= $flat->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="box-footer">
                <div class="button-group">
                    <a href="<?= route('devices') ?>" class="button">Annuler</a>
                    <button type="submit" class="button cta">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>